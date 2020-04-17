import Vue from 'vue'
import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'

// Components

const requireComponent = require.context(
  '../components/global',
  false,
  /Ct[A-Z]\w+\.(vue|js)$/
)

requireComponent.keys().forEach((fileName) => {
  const componentConfig = requireComponent(fileName)

  const componentName = upperFirst(
    camelCase(fileName.replace(/^\.\/(.*)\.\w+$/, '$1'))
  )

  Vue.component(componentName, componentConfig.default || componentConfig)
})

Vue.prototype.$global_utilities = {
  default_img: () => {
    return '/img/logo/logo_150_150.png'
  },
  require_img: (image_path) => {
    return '/img/' + image_path
  },
  require_img_product: (image_path) => {
    return `/img/product/barRestaurant/${image_path}`
  }
}

// Added functions
Object.byString = function(o, s) {
  s = s.replace(/\[(\w+)\]/g, '.$1') // convert indexes to properties
  s = s.replace(/^\./, '') // strip a leading dot
  const a = s.split('.')
  for (let i = 0, n = a.length; i < n; ++i) {
    const k = a[i]
    if (k in o) {
      o = o[k]
    } else {
      return
    }
  }
  return o
}
