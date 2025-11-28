import i18n from "i18next";
import { initReactI18next } from "react-i18next";

import en from "./en/en.json";
import ar from "./ar/ar.json";

i18n
    .use(initReactI18next)
    .init({
        resources: {
            en: {
                translation: en
            },
            ar: {
                translation: ar
            }
        },
        lng: "en",
        fallbackLng: "en",

        interpolation: {
            escapeValue: false // react already safes from xss => https://www.i18next.com/translation-function/interpolation#unescape
        }
    });

export default i18n;
