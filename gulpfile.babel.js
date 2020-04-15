import yargs from 'yargs';
import chug from 'gulp-chug';
import gulp from 'gulp';

const { argv } = yargs
  .options({
    rootPath: {
      description: '<path> path to web assets directory',
      type: 'string',
      requiresArg: true,
      required: false,
    },
    nodeModulesPath: {
      description: '<path> path to node_modules directory',
      type: 'string',
      requiresArg: true,
      required: false,
    },
  });

const config = [
  '--rootPath',
  argv.rootPath || '../../../public/assets',
  '--nodeModulesPath',
  argv.nodeModulesPath || '../../../node_modules',
];

export const buildAdmin = function buildAdmin() {
  return gulp.src('templates/bundles/SyliusAdminBundle/gulpfile.babel.js', { read: false })
    .pipe(chug({ args: config, tasks: 'build' }));
};
buildAdmin.description = 'Build admin assets.';

export const watchAdmin = function watchAdmin() {
  return gulp.src('templates/bundles/SyliusAdminBundle//gulpfile.babel.js', { read: false })
    .pipe(chug({ args: config, tasks: 'watch' }));
};
watchAdmin.description = 'Watch admin asset sources and rebuild on changes.';

export const buildShop = function buildShop() {
  return gulp.src('templates/bundles/SyliusShopBundle/gulpfile.babel.js', { read: false })
    .pipe(chug({ args: config, tasks: 'build' }));
};
buildShop.description = 'Build shop assets.';

export const watchShop = function watchShop() {
  return gulp.src('templates/bundles/SyliusShopBundle/gulpfile.babel.js', { read: false })
    .pipe(chug({ args: config, tasks: 'watch' }));
};
watchShop.description = 'Watch shop asset sources and rebuild on changes.';

// Sylius default shop bundle disabled
// export const build = gulp.parallel(buildAdmin, buildShop);
export const build = gulp.parallel(buildAdmin);
build.description = 'Build assets.';
