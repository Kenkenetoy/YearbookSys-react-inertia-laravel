import AdminDashboard from '@/components/Admin/AdminDashboard';
import { Head } from '@inertiajs/react';
import React from 'react';

export default function Dashboard() {
    const [users, setUsers] = React.useState([]);

    React.useEffect(() => {
        axios
            .get('http://127.0.0.1:8000/admin/users/pending')
            .then((response) => setUsers(response.data))
            .catch((error) => console.error('Error fetching users:', error));
    }, []);
    return (
        <>
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div>
                            <AdminDashboard />
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

// Assign the authenticated layout dynamically
Dashboard.layout = 'authenticated';
