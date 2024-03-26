// Import necessary components and hooks
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Link, useForm, usePage } from '@inertiajs/react';
import { Transition } from '@headlessui/react';

// The main functional component that renders the form for updating the user's profile information
export default function UpdateProfileInformation({
  mustVerifyEmail, // Determines if the user must verify their email
  status, // Status message for the form
  className = '', // Additional CSS classes for styling
}: {
  mustVerifyEmail: boolean;
  status: string;
  className?: string;
}) {
  // Get the authenticated user from the Inertia page props
  const user = usePage().props.auth.user;

  // Initialize the useForm hook with initial data and validation rules
  const { data, setData, patch, errors, processing, recentlySuccessful } = useForm<{
    name: string;
    email: string;
  }>({
    name: user.name,
    email: user.email,
  });

  // The submit callback function for handling form submission
  const submit = useCallback((e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    patch(route('profile.update')); // Send a PATCH request to the profile update route
  }, [patch]);

  // Return the JSX for rendering the form
  return (
    <section className={className}>
      {/* Header with the title and description of the form */}
      <header>
        <h2 className="text-lg font-medium text-gray-900 dark:text-gray-100">Profile Information</h2>
        <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
          Update your account's profile information and email address.
        </p>
      </header>
      {/* The form with input fields and error handling */}
      <form onSubmit={submit} className="mt-6 space-y-6">
        {/* Name input field */}
        <div>
          <InputLabel htmlFor="name" value="Name" />
          <TextInput
            id="name"
            className="mt-1 block w-full"
            value={data.name}
            onChange={(e) => setData('name', e.target.value)}
            required
            isFocused
            autoComplete="name"
            minLength={2}
            maxLength={50}
            autoCapitalize="words"
          />
          <InputError className="mt-2" message={errors.name} />
        </div>
        {/* Email input field */}
        <div>
          <InputLabel htmlFor="email" value="Email" />
          <TextInput
            id="email"
            type="email"
            className="mt-1 block w-full"
            value={data.email}
            onChange={(e) => setData('email', e.target.value)}
            required
            autoComplete="username"
            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
          />
          <InputError className="mt-2" message={errors.email} />
        </div>
        {/* Display verification-related UI if the user must verify their email and hasn't done so */}
        {mustVerifyEmail && user.email_verified_at === null && (
          <div>
            <p className="text-sm mt-2 text-gray-800 dark:text-gray-200">
              Your email address is unverified.
              <Link
                href={route('verification.send')}
                method="post"
                as="button"
                className="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
              >
                Click here to re-send the verification email.
              </Link>
            </p>
            {status === 'verification-link-sent' && (
              <div className="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                A new verification link has been sent to your email address.
              </div>
            )}
          </div>
        )}
        {/* Form submission button and success message */}
        <div className="flex items-center gap-4">
          <PrimaryButton type="submit" disabled={processing}>
            Save
          </PrimaryButton>
          <Transition
            show={recentlySuccessful}
            enter="transition ease-in-out"
            enterFrom="opacity-0"
            leave="transition ease-in-out"
            leaveTo="opacity-0"
          >
            <p className="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
          </Transition>
        </div>
      </form>
    </section>
  );
}

