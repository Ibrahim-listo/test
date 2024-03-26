import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

// This is the main dashboard component that users see after logging in.
// It displays a message saying "You're logged in!"
export default function Dashboard({ auth }) {
    return (
        <AuthenticatedLayout user={auth.user} key={auth.user.id}> {/* Render the AuthenticatedLayout component with the authenticated user data and a unique key */}
            <Head title="Dashboard" className="text-xl" /> {/* Set the title and additional class for the Head component */}

            <div className="py-12"> {/* Add padding to the top and bottom of the container */}
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8"> {/* Center the container and apply responsive padding */}
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> {/* Apply background, shadow, and rounded corners to the container */}
                        <div className="p-6 text-gray-900 dark:text-gray-100"> {/* Add padding and set text color for the inner container */}
                            You're logged in! {/* Display the logged-in message */}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

