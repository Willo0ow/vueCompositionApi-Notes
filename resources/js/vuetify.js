import "vuetify/styles";
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import {createVuetify} from 'vuetify';
import pl from 'vuetify/lib/locale/pl'

export default createVuetify(
    {
        lang: {
            locales: { pl },
            current: 'pl',
        },
        components,
        directives,
        icons: {iconfont:'mdi'}

    }
)