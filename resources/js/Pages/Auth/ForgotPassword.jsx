// Import necessary components and hooks
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, useEffect, useForm } from '@inertiajs/react';

// ForgotPassword component
export default function ForgotPassword({ status }) {
  // Use the useForm hook to handle form state and validation
  const { data, setData, post, processing, errors, reset } = useForm({
    email: '',
  });

  // Clean up the form data when the component unmounts
  useEffect(() => {
    return () => {
      reset();
    };
  }, []);

  // Handle form submission
  const handleSubmit = (e) => {
    e.preventDefault();
    post(route('password.email'));
  };

  // Return the JSX for the component
  return (
    <GuestLayout>
      <Head title="Forgot Password" /> {/* Set the page title */}

      <div className="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {/* Display error messages if there are any */}
        <InputError message={errors.email} className="mt-2" />

        {/* Email input field */}
        <TextInput
          id="email"
          type="email"
          name="email"
          value={data.email}
          className="mt-1 block w-full"
          autoComplete="username"
          isFocused={true}
          handleChange={(e) => setData('email', e.target.value)}
          placeholder="Email"
        />

        {/* Submit button */}
        <PrimaryButton className="mt-4" processing={processing}>
          Email Password Reset Link
        </PrimaryButton>
      </div>
    </GuestLayout>
  );
}
