import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

// This is the main dashboard page that users see after logging in.
// It displays a message saying "You're logged in!"

export default function Dashboard({ auth }) {
    return (
        <AuthenticatedLayout user={auth.user} key={auth.user.id}>
            <Head title="Dashboard" className="text-xl" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            You're logged in!
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

