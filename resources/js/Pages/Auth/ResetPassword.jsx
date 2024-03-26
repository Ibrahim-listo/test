import { useEffect } from 'react';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, useForm } from '@inertiajs/react';

export default function ResetPassword({ token, email }) {
  // Initialize useForm hook with initial data and configuration
  const { data, setData, post, processing, errors, reset } = useForm({
    token: token, // The received token
    email: email, // The received email
    password: '', // Initial value for password
    password_confirmation: '', // Initial value for password confirmation
  }, {
    resetOnSuccess: true, // Reset form data after successful submission
    initialValues: { // Set initial values for email, password, and password confirmation fields
      email: email,
      password: '',
      password_confirmation: '',
    }
  });

  // Clean up function to reset password fields when the component unmounts
  useEffect(() => {
    return () => {
      reset('password', 'password_confirmation');
    };
  }, []);

  // Submit function for handling form submission
  const submit = (e) => {
    e.preventDefault();

    post(route('password.store'), { // Send a POST request to the password reset route
      onFinish: () => reset('password', 'password_confirmation'), // Reset password fields after successful submission
    });
  };

  return (
    <GuestLayout>
      <Head title="Reset Password" />

      {/* The form for resetting the password */}
      <form onSubmit={submit}>
        <div>
          <InputLabel htmlFor="email-input" value="Email" /> {/* Label for the email input field */}

          <TextInput
            id="email-input"
            type="email"
            name="email"
            value={data.email}
            className="mt-1 block w-full"
            autoComplete="username"
            required
            onChange={(e) => setData('email', e.target.value)}
          />

          <InputError message={errors.email} className="mt-2" /> {/* Error message for email field */}
        </div>

        <div className="mt-4">
          <InputLabel htmlFor="password-input" value="Password" /> {/* Label for the password input field */}

          <TextInput
            id="password-input"
            type="password"
            name="password"
            value={data.password}
            className="mt-1 block w-full"
            autoComplete="new-password"
            required
            isFocused={true}
            onChange={(e) => setData('password', e.target.value)}
          />

          <InputError message={errors.password} className="mt-2" /> {/* Error message for password field */}
        </div>

        <div className="mt-4">
          <InputLabel htmlFor="password_confirmation-input" value="Confirm Password" /> {/* Label for the password confirmation input field */}

          <TextInput
            id="password_confirmation-input"
            type="password"
            name="password_confirmation"
            value={data.password_confirmation}
            className="mt-1 block w-full"
            autoComplete="new-password"
            required
            minLength={data.password.length}
            onChange={(e) => setData('password_confirmation', e.target.value)}
          />

          <InputError message={errors.password_confirmation} className="mt-2" /> {/* Error message for password confirmation field */}
        </div>

        <div className="flex items-center justify-end mt-4">
          <PrimaryButton className="ms-4" disabled={processing}>
            Reset Password
          </PrimaryButton>
        </div>
      </form>
    </GuestLayout>
  );
}

