import Vue from 'vue'
import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'

// Components

const requireComponent = require.context(
  '../globalComponents',
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
  },
}
