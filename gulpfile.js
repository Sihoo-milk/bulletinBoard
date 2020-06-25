// gulpプラグインを読み込みます
const { src, dest, watch } = require("gulp");
// Sassをコンパイルするプラグインを読み込みます
const sass = require("gulp-sass");

/**
 * Sassをコンパイルするタスクです
 */
const compileSass = () =>
  // style.scssファイルを取得
  src("../scss/**/*.scss")
    // Sassのコンパイルを実行
    .pipe(
      // コンパイル後のCSSを展開
      sass({
        outputStyle: "expanded"
      })
    )
    // cssフォルダー以下に保存
    .pipe(dest("./css/"));

/**
 * Sassファイルを監視し、変更があったらSassを変換します
 */
const watchSassFiles = () => watch("./scss/**/*.scss", compileSass);

// npx gulpというコマンドを実行した時、watchSassFilesが実行されるようにします
exports.default = watchSassFiles;



// gulpプラグインの読みこみ
var gulp = require("gulp");

// browser-syncのプラグインの読み込み
var browserSync = require("browser-sync");

// タスクの設定
gulp.task("browserSyncTask", function() {
  browserSync({
    server: {
      baseDir: "../bulletinBoard/" // ルートとなるディレクトリを指定
    }
  });

  // srcフォルダ以下のファイルを監視
  gulp.watch("../bulletinBoard/**", function() {
    browserSync.reload(); // ファイルに変更があれば同期しているブラウザをリロード
  });
});
