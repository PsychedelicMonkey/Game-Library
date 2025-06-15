import { createInertiaApp } from '@inertiajs/react'
import createServer from '@inertiajs/react/server'
import ReactDOMServer from 'react-dom/server'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { type RouteName, route } from 'ziggy-js';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createServer(page =>
    createInertiaApp({
        page,
        title: title => `${title} - ${appName}`,
        render: ReactDOMServer.renderToString,
        resolve: name => resolvePageComponent(`./pages/${name}.tsx`, import.meta.glob('./pages/**/*.tsx')),
        setup: ({ App, props }) => {
            // @ts-expect-error
                global.route<RouteName> = (name, params, absolute) =>
                    route(name, params as any, absolute, {
                        // @ts-expect-error
                            ...page.props.ziggy,
                        // @ts-expect-error
                            location: new URL(page.props.ziggy.location),
                    })

                return <App {...props} />;
        },
    }),
)
