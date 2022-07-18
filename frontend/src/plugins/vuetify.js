import '@fortawesome/fontawesome-free/css/all.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import colors from 'vuetify/lib/util/colors'
import Vue from 'vue'
import Vuetify from 'vuetify/lib/framework'

Vue.use(Vuetify)

export default new Vuetify({
  icons: {
    iconfont: 'md' || 'fa' || 'md'
  },
  theme: {
    themes: {
      light: {
        primary: '#7c92FE',
        secondary: '#1A237E'
      }
    }
  }
})
