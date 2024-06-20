import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-nova-nested-inputs', IndexField)
  app.component('detail-nova-nested-inputs', DetailField)
  app.component('form-nova-nested-inputs', FormField)
})
