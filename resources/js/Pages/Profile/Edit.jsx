// Import necessary components and hooks
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import DeleteUserForm from './Partials/DeleteUserForm';
import UpdatePasswordForm from './Partials/UpdatePasswordForm';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm';
import { Head } from '@inertiajs/react';
import { useEffect } from 'react';

// Define the Edit component, receiving auth, mustVerifyEmail, and status
// as props
export default function Edit({ auth, mustVerifyEmail, status }) {
  // Use the effect hook to set the page title using Inertia's Head component
  useEffect(() => {
    document.title = 'Profile';
  }, []);

  return (
    <AuthenticatedLayout
      // Pass the user object from auth prop to AuthenticatedLayout's user prop
      user={auth.user}
      // Set the header content for AuthenticatedLayout
      header={
        <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          Profile
        </h2>
      }
    >
      {/* Add a Head component to set the page title for SEO purposes */}
      <Head title="Profile" />

      <div className="py-12">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
          {/* UpdateProfileInformationForm component with mustVerifyEmail, status, and className props */}
          <div className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <UpdateProfileInformationForm
              mustVerifyEmail={mustVerifyEmail}
              status={status}
              className="max-w-xl"
            />
          </div>

          {/* UpdatePasswordForm component with className prop */}
          <div className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <UpdatePasswordForm className="max-w-xl" />
          </div>

          {/* DeleteUserForm component with className prop */}
          <div className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <DeleteUserForm className="max-w-xl" />
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  );
