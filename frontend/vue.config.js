module.exports = {
  transpileDependencies: [
    'vuetify'
  ],
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
