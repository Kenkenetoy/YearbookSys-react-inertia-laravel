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
        const page = pages[`./Pages/${name}.jsx`];

        // Assign a default layout dynamically based on user auth status in props
        const withDefaultLayout = (component) => {
            component.layout = (page) => {
                const user = page.props?.auth?.user; // Ensure safe access to props
                return user ? (
                    <AuthenticatedLayout>{page}</AuthenticatedLayout>
                ) : (
                    <Layout>{page}</Layout>
                );
            };
            return component;
        };

        return withDefaultLayout(page.default);
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
