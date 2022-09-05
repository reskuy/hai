module.exports = {
  transpileDependencies: [
    'vuetify'
  ],
  // devServer: {
  //   open: process.platform === 'win32',
  //   host: '0.0.0.0',
  //   port: 8080, // CHANGE YOUR PORT HERE!
  //   https: true,
  //   // http2:true,
  //   // hotOnly: true,
  //   compress: true,
  //   liveReload: true,
  // },
  publicPath: process.env.NODE_ENV === 'production'
  ? './'
  : '/',
  pages: {
    index: {
      entry: 'src/main.js',
      chunks: 'all'
    }
  },
  pwa: {
    // configure the workbox plugin
    workboxPluginMode: 'InjectManifest',
    workboxOptions: {
        swSrc: 'public/service-worker.js',
    }
  }
}
