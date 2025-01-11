import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/react';
import { createRoot } from 'react-dom/client';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Layout from '@/Layouts/Layout';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true });
        let page = pages[`./Pages/${name}.jsx`];

        // Apply the authenticated layout if specified
        if (page.default.layout === 'authenticated') {
            page.default.layout = (content) => (
                <AuthenticatedLayout>{content}</AuthenticatedLayout>
            );
        } else if (!page.default.layout) {
            // Apply the default layout
            page.default.layout = (content) => <Layout>{content}</Layout>;
        }

        return page;
    },
    setup({ el, App, props }) {
        const root = createRoot(el);

        root.render(<App {...props} />);
    },
    progress: {
        delay: 250,
        color: '#29d',
        includeCSS: true,
        showSpinner: true,
    },
});
