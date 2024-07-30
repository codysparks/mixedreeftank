/* eslint-disable no-console */

const gulp = require('gulp');
const GulpSSH = require('gulp-ssh');
const exec = require('child_process').exec;
const gunzip = require('gulp-gunzip');
const untar = require('gulp-untar');

const homedir = require('os').homedir();
const fs = require('fs');
const request = require('request');

const config = {
	// SSH connection
	host: '74.208.80.173',
	port: 22,
	username: 'root',
	privateKey: fs.readFileSync(homedir + '/.ssh/id_rsa'),

	// Sever connection
	host_db: 'mixedreeftank',
	host_user: 'admin',

	// MySQL connection
	local_host: 'localhost',
	local_db: 'mixedreeftank',
	local_user: 'user',
	local_password: 'password',
};

// Connect
const gulpSSH = new GulpSSH({
	ignoreErrors: true,
	sshConfig: config,
});

// Dump MySQL
gulp.task('download-db', function () {
	return gulpSSH.exec([`MYSQL_PWD=\`cat /etc/psa/.psa.shadow\` mysqldump -u ${config.host_user} ${config.host_db} | sed '1d' | gzip`], { filePath: config.host_db + '.sql.gz' }).pipe(gulp.dest('sync'));
});

// Unzip
gulp.task('unzip-db', function () {
	return gulp.src(`./sync/${config.host_db}.sql.gz`).pipe(gunzip()).pipe(gulp.dest('./sync'));
});

// Clean DB
gulp.task('clean-db', function (cb) {
	exec(`docker exec mixedreeftank-mysql mysql -u ${config.local_user} -p${config.local_password} -e "DROP DATABASE ${config.local_db}; CREATE DATABASE ${config.local_db}"`, function (err) {
		cb(err);

		if (err) {
			console.log(err);
		}
	});
});

// Import DB
gulp.task('import-db', function (cb) {
	exec(`docker exec -i mixedreeftank-mysql mysql -u ${config.local_user} -p${config.local_password} ${config.local_db} < ./sync/${config.host_db}.sql`, function (err) {
		cb(err);

		if (err) {
			console.log(err);
		}
	});
});

// Config WP
gulp.task('config-wp', function (cb) {
	exec(
		`docker exec -i mixedreeftank-mysql mysql -u ${config.local_user} -p${config.local_password} -e "USE ${config.local_db}; UPDATE mrt_options SET option_value = 'http://mixedreeftank.local' WHERE mrt_options.option_name = 'siteurl'; UPDATE mrt_options SET option_value = 'http://mixedreeftank.local' WHERE mrt_options.option_name = 'home';"`,
		function (err) {
			cb(err);

			if (err) {
				console.log(err);
			}
		}
	);
});

// Sync Fies
gulp.task('package-archive', function (cb) {
	exec(`ssh ${config.username}@${config.host} tar -czvf /var/www/vhosts/mixedreeftank.com/httpdocs/uploads.tar.gz -C /var/www/vhosts/mixedreeftank.com/httpdocs/wp-content uploads`, { maxBuffer: 1024 * 1024 }, function (err) {
		cb(err);

		if (err) {
			console.log(err);
		}
	});
});

// Package Fies
gulp.task('package-files', function (cb) {
	const date = previousDate(60);

	exec(`ssh ${config.username}@${config.host} tar --exclude='*.pdf' --newer-mtime="${date}" -czvf /var/www/vhosts/mixedreeftank.com/httpdocs/uploads.tar.gz -C /var/www/vhosts/mixedreeftank.com/httpdocs/wp-content uploads`, function (err) {
		cb(err);

		if (err) {
			console.log(err);
		}
	});
});

// Download Files
gulp.task('download-files', function () {
	return request('https://mixedreeftank.com/uploads.tar.gz').pipe(fs.createWriteStream('sync/uploads.tar.gz'));
});

// Unzip Files
gulp.task('unzip-files', function () {
	return gulp.src(`./sync/uploads.tar.gz`).pipe(gunzip()).pipe(untar()).pipe(gulp.dest('./wp-content'));
});

// Clean Files
gulp.task('clean-files', function () {
	return gulpSSH.exec(`mv /var/www/vhosts/mixedreeftank.com/httpdocs/uploads.tar.gz /var/www/vhosts/mixedreeftank.com`);
});

// SYNC DB
gulp.task('sync-db', gulp.series('download-db', 'unzip-db', 'clean-db', 'import-db', 'config-wp'));

// SYNC ARCHIVE
gulp.task('sync-archive', gulp.series('package-archive', 'download-files', 'unzip-files', 'clean-files'));

// SYNC FILES
gulp.task('sync-files', gulp.series('package-files', 'download-files', 'unzip-files', 'clean-files'));

// SYNC ALL
gulp.task('sync', gulp.series('sync-db', 'sync-files'));

/* Get previous date
# @days {Int} - number of days from current day
# return {String} - previous date
*/
function previousDate(days) {
	const date = new Date();
	date.setDate(date.getDate() - days);

	const year = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(date);
	let month = new Intl.DateTimeFormat('en', { month: 'numeric' }).format(date);
	if (month < 10) {
		month = '0' + month;
	}
	let day = new Intl.DateTimeFormat('en', { day: 'numeric' }).format(date);
	if (day < 10) {
		day = '0' + day;
	}

	return year + month + day;
}
