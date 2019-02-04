"use strict";

// NODE_ENV=production npm run build - Command for production task

// Global
const gulp = require("gulp");
const plumber = require("gulp-plumber");
const rimraf = require("gulp-rimraf");
const rename = require("gulp-rename");
const cheerio = require("gulp-cheerio");
const gulpIf = require("gulp-if");
const size = require(`gulp-size`);
const sourcemaps = require(`gulp-sourcemaps`);
const server = require("browser-sync").create();

// SVG, PNG, JPG, WEBP
const imagemin = require("gulp-imagemin");
const svgmin = require("gulp-svgmin");
const svgstore = require("gulp-svgstore");
const webp = require("gulp-webp");

// JS
const babel = require("gulp-babel");
const uglify = require("gulp-uglify");
const concat = require("gulp-concat");
const webpack = require("webpack-stream");

// CSS
const sass = require("gulp-sass");
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const cssnano = require("gulp-cssnano");

const isProduction = process.env.NODE_ENV == "production";
const proxyName = "http://theatre.loc/";

var path = {
  src: {
    phpBlade: ["resources/assets/**/*.blade.php", "!resources/assets/layouts/**/*.blade.php"],
    phpLayout: "resources/assets/layouts/*.blade.php",
    jsGlobal: ["resources/assets/global/_blocks/**/*.js", "!resources/assets/global/_blocks/**/jq-*.js"],
    jsConcierge: ["resources/assets/concierge/**/*.js", "!resources/assets/global/**/jq-*.js"],
    jsGlobalJq: "resources/assets/global/_blocks/**/jq-*.js",
    jsTheatre: ["resources/assets/theatre/_blocks/**/*.js", "!resources/assets/theatre/_blocks/**/jq-*.js"],
    jsTheatreJq: "resources/assets/theatre/_blocks/**/jq-*.js",
    jsShop: ["resources/assets/shop/_blocks/**/*.js", "!resources/assets/shop/_blocks/**/jq-*.js"],
    jsShopJq: "resources/assets/shop/_blocks/**/jq-*.js",
    jsTicket: ["node_modules/babel-polyfill/dist/polyfill.js", "resources/assets/ticket/main.js"],
    jsTicketsDesigner: ["node_modules/babel-polyfill/dist/polyfill.js", "resources/assets/tickets-designer/main.js"],
    jsUser: ["node_modules/babel-polyfill/dist/polyfill.js", "resources/assets/user/main.js"],
    jsCartGlobal: "resources/assets/cart-global/**/*.js",
    jsAdmin: ["node_modules/babel-polyfill/dist/polyfill.js", "resources/views/admin/webpack/main.js"],
    jsKasir: ["node_modules/babel-polyfill/dist/polyfill.js", "resources/assets/kasir/main.js"],
    pluginsJS: "resources/assets/plugins/**/*.js*",
    pluginsCSS: "resources/assets/plugins/**/*.scss*",
    css: [
      "resources/assets/global/scss/global.scss",
      "resources/assets/theatre/scss/theatre.scss",
      "resources/assets/ticket/scss/ticket.scss",
      "resources/assets/shop/scss/shop.scss",
      "resources/assets/user/scss/user.scss",
      "resources/assets/concierge/scss/concierge.scss",
      "resources/assets/tickets-designer/scss/tickets-designer.scss",
      "resources/assets/cart-global/cart-global.scss",
      "resources/assets/kasir/scss/kasir.scss"
    ],
    img: "resources/assets/img/_blocks/**/*.{png,jpg,gif,webp}",
    blocksvg: "resources/assets/img/_blocks/**/*.svg",
    fonts: "resources/assets/fonts/**/*.*",
    favicon: "resources/assets/img/favicon/*",
    svg: "resources/assets/img/svg/*.svg",
    webmanifest: "resources/assets/manifest-*.json"
  },
  watch: {
    css: ["resources/assets/**/*.scss", "!resources/assets/plugins/**/*.scss"],
    blade: [
      "resources/assets/global/_blocks/**/*.blade.php",
      "resources/assets/theatre/_blocks/**/*.blade.php",
      "resources/assets/theatre/pages/**/*.blade.php",
      "resources/assets/shop/_blocks/**/*.blade.php",
      "resources/assets/shop/pages/**/*.blade.php",
      "resources/assets/layouts/*.blade.php"
    ],
    user: `resources/assets/user/**/*`,
    ticket: `resources/assets/ticket/**/*`,
    cartGlobal: `resources/assets/cart-global/**/*`,
    concierge: `resources/assets/concierge/**/*`,
    ticketsDesigner: `resources/assets/tickets-designer/**/*`,
    kasir: `resources/assets/kasir/**/*`,
    admin: `resources/views/admin/webpack/**/*`
  },
  build: {
    phpBlade: "resources/views/pages/",
    phpLayout: "resources/views/layouts/",
    js: "public/design/js/",
    jsAdmin: "public/js/admin/",
    plugins: "public/design/plugins",
    css: "public/design/css/",
    img: "public/design/img/",
    svg: "resources/views/pages/global/_blocks/svg/",
    fonts: "public/design/fonts/",
    favicon: "public/design/img/favicon/",
    webmanifest: "public/"
  },
  clean: ["resources/views/pages", "public/design/", "public/manifest-*.json"],
};

gulp.task("clean", () => {
  return gulp.src(path.clean, {read: false})
         .pipe(rimraf());
});

gulp.task("webp", () => {
  return gulp.src("resources/assets/img/_blocks/**/*.{png,jpg}")
  .pipe(webp({quality: 90}))
  .pipe(gulp.dest("resources/assets/img/_blocks/"));
});

gulp.task("symbols", () => {
  return gulp.src(path.src.svg)
    .pipe(svgmin())
    .pipe(svgstore({inlineSvg: true}))
    .pipe(cheerio({
      run: function($) {
        $("svg").attr("style", "display:none");
      },
      parserOptions: { xmlMode: true }
    }))
    .pipe(rename("symbols.blade.php"))
    .pipe(gulp.dest(path.build.svg))
    .pipe(server.stream());
});

gulp.task("fonts", () => {
  return gulp.src(path.src.fonts)
    .pipe(size({ showFiles: true }))
    .pipe(gulp.dest(path.build.fonts))
    .pipe(server.stream());
});

gulp.task("blocksvg", () => {
  return gulp.src(path.src.blocksvg)
    .pipe(gulpIf(isProduction, svgmin()))
    .pipe(size({ showFiles: true }))
    .pipe(gulp.dest(path.build.img))
    .pipe(server.stream());
});

gulp.task("copyfavicon", () => {
  return gulp.src(path.src.favicon)
    .pipe(gulp.dest(path.build.favicon))
    .pipe(server.stream());
});

gulp.task("copywebmanifest", () => {
  return gulp.src(path.src.webmanifest)
    .pipe(size({ showFiles: true }))
    .pipe(gulp.dest(path.build.webmanifest))
    .pipe(server.stream());
});

gulp.task("pluginsJS", () => {
  return gulp.src(path.src.pluginsJS)
    .pipe(gulp.dest(path.build.plugins))
    .pipe(server.stream());
});

gulp.task("pluginsCSS", () => {
  return gulp.src(path.src.pluginsCSS)
    .pipe(plumber())
    .pipe(sass())
    .pipe(postcss([
      autoprefixer()
    ]))
    .pipe(gulpIf(isProduction, cssnano({ discardComments: { removeAll: true } })))
    .pipe(gulp.dest(path.build.plugins))
    .pipe(server.stream());
});

gulp.task("copyBlade", () => {
  return gulp.src(path.src.phpBlade)
    .pipe(gulp.dest(path.build.phpBlade))
    .pipe(server.stream());
});

gulp.task("copyLayouts", () => {
  return gulp.src(path.src.phpLayout)
    .pipe(gulp.dest(path.build.phpLayout))
    .pipe(server.stream());
});

gulp.task("style", () => {
  return gulp.src(path.src.css)
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postcss([
      autoprefixer()
    ]))
    .pipe(gulpIf(isProduction, cssnano({ discardComments: { removeAll: true } })))
    .pipe(sourcemaps.write())
    .pipe(size({ showFiles: true }))
    .pipe(gulp.dest(path.build.css))
    .pipe(server.stream());
});

gulp.task("scriptsGlobal", () => {
  return gulp.src(path.src.jsGlobal)
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ["env"]
    }))
    .pipe(concat("global.js"))
    .pipe(gulpIf(isProduction, uglify()))
    .pipe(sourcemaps.write())
    .pipe(size({ showFiles: true }))
    .pipe(gulp.dest(path.build.js))
    .pipe(server.stream());
});

gulp.task("scriptsGlobalJq", () => {
  return gulp.src(path.src.jsGlobalJq)
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ["env"]
    }))
    .pipe(concat("jq-global.js"))
    .pipe(gulpIf(isProduction, uglify()))
    .pipe(sourcemaps.write())
    .pipe(size({ showFiles: true }))
    .pipe(gulp.dest(path.build.js))
    .pipe(server.stream());
});

gulp.task("scriptsConcierge", () => {
  return gulp.src(path.src.jsConcierge)
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ["env"]
    }))
    .pipe(concat("concierge.js"))
    .pipe(gulpIf(isProduction, uglify()))
    .pipe(sourcemaps.write())
    .pipe(size({ showFiles: true }))
    .pipe(gulp.dest(path.build.js))
    .pipe(server.stream());
});

gulp.task("scriptsTheatre", () => {
  return gulp.src(path.src.jsTheatre)
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ["env"]
    }))
    .pipe(concat("theatre.js"))
    .pipe(gulpIf(isProduction, uglify()))
    .pipe(sourcemaps.write())
    .pipe(size({ showFiles: true }))
    .pipe(gulp.dest(path.build.js))
    .pipe(server.stream());
});

gulp.task("scriptsTheatreJq", () => {
  return gulp.src(path.src.jsTheatreJq)
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ["env"]
    }))
    .pipe(concat("jq-theatre.js"))
    .pipe(gulpIf(isProduction, uglify()))
    .pipe(sourcemaps.write())
    .pipe(size({ showFiles: true }))
    .pipe(gulp.dest(path.build.js))
    .pipe(server.stream());
});

gulp.task("scriptsShop", () => {
  return gulp.src(path.src.jsShop)
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ["env"]
    }))
    .pipe(concat("shop.js"))
    .pipe(gulpIf(isProduction, uglify()))
    .pipe(sourcemaps.write())
    .pipe(size({ showFiles: true }))
    .pipe(gulp.dest(path.build.js))
    .pipe(server.stream());
});

gulp.task("scriptsShopJq", () => {
  return gulp.src(path.src.jsShopJq)
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ["env"]
    }))
    .pipe(concat("jq-shop.js"))
    .pipe(gulpIf(isProduction, uglify()))
    .pipe(sourcemaps.write())
    .pipe(size({ showFiles: true }))
    .pipe(gulp.dest(path.build.js))
    .pipe(server.stream());
});

gulp.task("scriptsUser", () => {
  return gulp.src(path.src.jsUser)
        .pipe(webpack(require("./webpack.config.js")))
        .pipe(rename("user.js"))
        .pipe(size({ showFiles: true }))
        .pipe(gulp.dest(path.build.js))
        .pipe(server.stream());
});

gulp.task("scriptsTicket", () => {
  return gulp.src(path.src.jsTicket)
        .pipe(webpack(require("./webpack.config.js")))
        .pipe(rename("ticket.js"))
        .pipe(size({ showFiles: true }))
        .pipe(gulp.dest(path.build.js))
        .pipe(server.stream());
});

gulp.task("scriptsKasir", () => {
  return gulp.src(path.src.jsKasir)
        .pipe(webpack(require("./webpack.config.js")))
        .pipe(rename("kasir.js"))
        .pipe(size({ showFiles: true }))
        .pipe(gulp.dest(path.build.js))
        .pipe(server.stream());
});

gulp.task("scriptsTicketsDesigner", () => {
  return gulp.src(path.src.jsTicketsDesigner)
        .pipe(webpack(require("./webpack.config.js")))
        .pipe(rename("tickets-designer.js"))
        .pipe(size({ showFiles: true }))
        .pipe(gulp.dest(path.build.js))
        .pipe(server.stream());
});

gulp.task("scriptsCartGlobal", () => {
  return gulp.src(path.src.jsCartGlobal)
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ["env"]
    }))
    .pipe(concat("cart-global.js"))
    .pipe(gulpIf(isProduction, uglify()))
    .pipe(sourcemaps.write())
    .pipe(size({ showFiles: true }))
    .pipe(gulp.dest(path.build.js))
    .pipe(server.stream());
});

gulp.task("scriptsAdmin", () => {
  return gulp.src(path.src.jsAdmin)
        .pipe(webpack(require("./webpack-admin.config.js")))
        .pipe(rename("kasir.js"))
        .pipe(size({ showFiles: true }))
        .pipe(gulp.dest(path.build.jsAdmin))
        .pipe(server.stream());
});

gulp.task("image", () => {
  return gulp.src(path.src.img)
    .pipe(gulpIf(isProduction, imagemin([
      imagemin.optipng({optimizationLevel: 3}),
      imagemin.jpegtran({progressive: true})
    ])))
    .pipe(gulp.dest(path.build.img))
    .pipe(server.stream());
});

gulp.task("server", () => {
  server.init({
    proxy: proxyName,
    notify: false,
    open: true,
    cors: true,
    ui: false
  });

  gulp.watch(path.src.img, gulp.parallel("image"));
  gulp.watch(path.watch.css, gulp.parallel("style"));
  gulp.watch(path.src.jsGlobal, gulp.parallel("scriptsGlobal"));
  gulp.watch(path.src.jsGlobalJq, gulp.parallel("scriptsGlobalJq"));
  gulp.watch(path.src.jsTheatre, gulp.parallel("scriptsTheatre"));
  gulp.watch(path.src.jsTheatreJq, gulp.parallel("scriptsTheatreJq"));
  gulp.watch(path.src.jsConcierge, gulp.parallel("scriptsConcierge"));
  gulp.watch(path.src.jsShop, gulp.parallel("scriptsShop"));
  gulp.watch(path.src.jsShopJq, gulp.parallel("scriptsShopJq"));

  gulp.watch(path.watch.user, gulp.parallel("scriptsUser"));
  gulp.watch(path.watch.ticket, gulp.parallel("scriptsTicket"));
  gulp.watch(path.watch.kasir, gulp.parallel("scriptsKasir"));
  gulp.watch(path.watch.ticketsDesigner, gulp.parallel("scriptsTicketsDesigner"));
  gulp.watch(path.watch.cartGlobal, gulp.parallel("scriptsCartGlobal"));
  gulp.watch(path.watch.admin, gulp.parallel("scriptsAdmin"));

  gulp.watch(path.src.pluginsJS, gulp.parallel("pluginsJS"));
  gulp.watch(path.src.pluginsCSS, gulp.parallel("pluginsCSS"));
  gulp.watch(path.src.fonts, gulp.parallel("fonts"));
  gulp.watch(path.src.favicon, gulp.parallel("copyfavicon"));
  gulp.watch(path.src.blocksvg, gulp.parallel("blocksvg"));
  gulp.watch(path.src.webmanifest, gulp.parallel("copywebmanifest"));
  gulp.watch(path.src.svg, gulp.parallel("symbols"));
  gulp.watch(path.watch.blade, gulp.parallel("copyBlade", "copyLayouts"));
});

// Build
gulp.task("build", (done) => {
  gulp.series(
    "clean",
    "symbols",
    gulp.parallel(
      "image",
      "style",
      "scriptsGlobal",
      "scriptsGlobalJq",
      "scriptsConcierge",
      "scriptsTheatre",
      "scriptsTheatreJq",
      "scriptsShop",
      "scriptsShopJq",
      "scriptsUser",
      "scriptsTicket",
      "scriptsTicketsDesigner",
      "scriptsKasir",
      "scriptsCartGlobal",
      "scriptsAdmin",
      "fonts",
      "pluginsJS",
      "pluginsCSS",
      "copyfavicon",
      "blocksvg",
      "copywebmanifest",
      "copyBlade",
      "copyLayouts"
    ),
    "server"
  )();

  done();
});
