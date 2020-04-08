var concat = require('gulp-concat');
var env = process.env.GULP_ENV;
var gulp = require('gulp');
var gulpif = require('gulp-if');
var livereload = require('gulp-livereload');
var merge = require('merge-stream');
var order = require('gulp-order');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');
var argv = require('yargs').argv;
var path = require('path');
var prefixcss = require('gulp-prefix-css');

var rootPath = argv.rootPath;
var shopRootPath = rootPath + 'shop/';
var shopPath = '';
var uiPath = '../SyliusUiBundle/';
var nodeModulesPath = argv.nodeModulesPath;

var paths = {
    shop: {
        js: [
            nodeModulesPath + 'jquery/dist/jquery.min.js',
            nodeModulesPath + 'jquery-number/jquery.number.min.js',
            nodeModulesPath + 'animsition/dist/js/animsition.min.js',
            nodeModulesPath + 'popper/dist/popper.min.js',
            nodeModulesPath + 'bootstrap/js/dist/bootstrap.min.js',
            nodeModulesPath + 'select2/dist/js/select2.min.js',
            nodeModulesPath + 'daterangepicker/moment.min.js',
            nodeModulesPath + 'daterangepicker/daterangepicker.js',
            nodeModulesPath + 'slick-carousel/slick/slick.min.js',
            nodeModulesPath + 'magnific-popup/dist/jquery.magnific-popup.min.js',
            nodeModulesPath + 'isotope-layout/dist/isotope.pkgd.min.js',
            shopPath + 'private/lib/sweetalert/sweetalert.min.js',
            shopPath + 'private/lib/cookies/js/privacycookie.js',
            nodeModulesPath + 'perfect-scrollbar/dist/perfect-scrollbar.min.js',
            nodeModulesPath + 'semantic-ui-css/semantic.min.js',
            nodeModulesPath + 'lightbox2/dist/js/lightbox.js',
            uiPath + 'private/js/**',
            shopPath + 'private/js/**'
        ],
        sass: [,
            nodeModulesPath + 'bootstrap/scss/bootstrap.scss',
            uiPath + 'private/sass/**',
            shopPath + 'private/scss/**'
        ],
        css: [
            nodeModulesPath + 'font-awesome/css/font-awesome.min.css',
            shopPath + 'private/fonts/iconic/css/material-design-iconic-font.min.css',
            shopPath + 'private/fonts/linearicons-v1.0.0/icon-font.min.css',
            shopPath + 'private/lib/animate/animate.css',
            shopPath + 'private/lib/cookies/css/privacycookie.css',
            nodeModulesPath + 'hamburgers/dist/hamburgers.min.css',
            nodeModulesPath + 'animsition/dist/css/animsition.min.css',
            nodeModulesPath + 'select2/dist/css/select2.min.css',
            nodeModulesPath + 'daterangepicker/daterangepicker.css',
            nodeModulesPath + 'slick-carousel/slick/slick.css',
            nodeModulesPath + 'magnific-popup/dist/magnific-popup.css',
            nodeModulesPath + 'perfect-scrollbar/css/perfect-scrollbar.css',
            nodeModulesPath + 'lightbox2/dist/css/lightbox.css',
            uiPath + 'private/css/**',
            shopPath + 'private/css/**'
        ],
        fonts: [
            shopPath + 'private/fonts/**',
            nodeModulesPath + 'font-awesome/fonts/**'
        ],
        img: [
            uiPath + 'private/img/**',
            shopPath + 'private/img/**'
        ]
    }
};

var sourcePathMap = [
    {
        sourceDir: path.relative('', shopPath + 'private/'),
        destPath: '/SyliusShopBundle/'
    },
    {
        sourceDir: path.relative('', uiPath + 'private/'),
        destPath: '/SyliusUiBundle/'
    },
    {
        sourceDir: path.relative('', nodeModulesPath),
        destPath: '/node_modules/'
    }
];

var mapSourcePath = function mapSourcePath(sourcePath, file) {
    for (var spec of sourcePathMap) {
        if (sourcePath.substring(0, spec.sourceDir.length) === spec.sourceDir) {
            return spec.destPath + sourcePath.substring(spec.sourceDir.length);
        }
    }

    return sourcePath;
};

gulp.task('shop-js', function () {
    return gulp.src(paths.shop.js, { base: './' })
        .pipe(gulpif(env !== 'prod', sourcemaps.init()))
        .pipe(concat('app.js'))
        .pipe(gulpif(env === 'prod', uglify()))
        .pipe(gulpif(env !== 'prod', sourcemaps.mapSources(mapSourcePath)))
        .pipe(gulpif(env !== 'prod', sourcemaps.write('./')))
        .pipe(gulp.dest(shopRootPath + 'js/'))
    ;
});

gulp.task('shop-css', function() {
    gulp.src([nodeModulesPath + 'semantic-ui-css/themes/**/*']).pipe(gulp.dest(shopRootPath + 'css/themes/'));

    var semanticUiPrefixed = gulp.src([nodeModulesPath + 'semantic-ui-css/semantic.min.css'])
            .pipe(prefixcss('.sui'))
            .pipe(concat('css-semantic-ui.css'))
        ;

    var cssStream = gulp.src(paths.shop.css, { base: './' })
            .pipe(gulpif(env !== 'prod', sourcemaps.init()))
            .pipe(concat('css-files.css'))
        ;

    var sassStream = gulp.src(paths.shop.sass, { base: './' })
            .pipe(gulpif(env !== 'prod', sourcemaps.init()))
            .pipe(sass({
                includePaths: [nodeModulesPath, uiPath, shopPath]
            }))
            .pipe(concat('sass-files.scss'))
        ;

    return merge(cssStream, sassStream, semanticUiPrefixed)
        .pipe(order(['css-semantic-ui.css', 'css-files.css', 'sass-files.scss']))
        .pipe(concat('style.css'))
        .pipe(gulpif(env === 'prod', uglifycss()))
        .pipe(gulpif(env !== 'prod', sourcemaps.mapSources(mapSourcePath)))
        .pipe(gulpif(env !== 'prod', sourcemaps.write('./')))
        .pipe(gulp.dest(shopRootPath + 'css/'))
        .pipe(livereload())
    ;
});

gulp.task('shop-img', function() {
    gulp.src([nodeModulesPath + 'lightbox2/dist/images/*']).pipe(gulp.dest(shopRootPath + 'images/'));

    return gulp.src(paths.shop.img)
        .pipe(gulp.dest(shopRootPath + 'img/'))
    ;
});

gulp.task('shop-fonts', function() {
    return gulp.src(paths.shop.fonts)
        .pipe(gulp.dest(shopRootPath + 'fonts/'))
    ;
});

gulp.task('shop-watch', function() {
    livereload.listen();

    gulp.watch(paths.shop.js, ['shop-js']);
    gulp.watch(paths.shop.sass, ['shop-css']);
    gulp.watch(paths.shop.css, ['shop-css']);
    gulp.watch(paths.shop.img, ['shop-img']);
    gulp.watch(paths.shop.fonts, ['shop-fonts']);
});

gulp.task('default', ['shop-js', 'shop-css', 'shop-img', 'shop-fonts']);
gulp.task('watch', ['default', 'shop-watch']);
