import {createI18n} from 'vue-i18n'

import en from '@/Shared/Languages/en.json'
import ph from '@/Shared/Languages/ph.json'

const messages = {
  en,
  ph
}

const locale = sessionStorage.getItem("locale");

const i18n = createI18n({
  locale:  locale || "en",
  fallbackLocale: "en",
  messages: messages
});
export default i18n;
