const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const glob = require('glob');

module.exports = (env, argv) => {
  const isProduction = argv.mode === 'production';

  return {
    entry: {
      main: './src/js/app.js',
      style: './src/scss/style.scss',
      blog: './src/js/blog.js',
      blogStyle: './src/scss/page-blog.scss',
      'editor-tweaks': './src/scss/editor-tweaks.scss',
      'single-post': './src/scss/single-post.scss',
      'singlePost': './src/js/single-post.js',

      // Optional: Auto-discover block scripts if you want separate bundles
      // ...glob.sync('./blocks/**/*.js').reduce((acc, path) => { ... }) 
    },
    output: {
      path: path.resolve(__dirname, 'build'),
      filename: 'js/[name].js',
      clean: true, // Clean build folder before each build
    },
    module: {
      rules: [
        {
          test: /\.scss$/,
          use: [
            MiniCssExtractPlugin.loader,
            'css-loader',
            'sass-loader',
          ],
        },
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader',
            options: { presets: ['@babel/preset-env'] }
          }
        }
      ],
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: 'css/[name].css',
      }),
      // Live Reload Configuration
      new BrowserSyncPlugin({
        proxy: 'http://localhost:8000', // Matches Docker port
        files: [
          '**/*.php',           // Reload on PHP change
          'build/**/*.css',     // Inject CSS changes
          'build/**/*.js'       // Reload on JS change
        ],
        reloadDelay: 0,
        notify: false,          // Turn off the annoying notification in corner
        open: false             // Don't open new tab automatically
      }),
    ],
    optimization: {
      minimize: isProduction,
      minimizer: [ new TerserPlugin(), new CssMinimizerPlugin() ],
    },
    devtool: isProduction ? false : 'source-map',
  };
};