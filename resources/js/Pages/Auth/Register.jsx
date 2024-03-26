// Import necessary dependencies and components for the React application
import { useEffect, useState } from 'react';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';

// The main Register component
export default function Register() {
  // Initialize state for showPassword using the useState hook
  const [showPassword, setShowPassword] = useState(false);

  // Initialize the useForm hook with initial data and configuration
  const { data, setData, post, processing, errors, reset } = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
  }, {
    initialValues: {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
    },
  });

  // useEffect cleanup function to reset the password fields when the component unmounts
  useEffect(() => {
    return () => {
      reset('password', 'password_confirmation');
    };
  }, []);

  // submit function to handle form submission
  const submit = (e) => {
    e.preventDefault();
    post(route('register'));
  };

  // handlePasswordChange function to update the password field
  const handlePasswordChange = (e) => {
    setData('password_confirmation', '');
    setData('password', e.target.value);
  };

  // handlePasswordFocus function to reset the password fields when the password input is focused
  const handlePasswordFocus = () => {
    setData('password', '');
    setData('password_confirmation', '');
    reset('password', 'password_confirmation');
  };

  // Render the Register component
  return (
    <GuestLayout>
      {/* Head component for setting the page title */}
      <Head title="Register" />

      {/* Form for registering a new user */}
      <form onSubmit={submit}>
        {/* Input field for the user's name */}
        <div>
          <InputLabel htmlFor="name" value="Name" />
          <TextInput
            id="name"
            name="name"
            value={data.name}
            className="mt-1 block w-full"
            autoComplete="name"
            autoFocus
            minHeight={16}
            placeholder="Enter your name"
            onChange={(e) => setData('name', e.target.value)}
            required
          />
          <InputError message={errors.name} className="mt-2" />
        </div>

        {/* Input field for the user's email */}
        <div className="mt-4">
          <InputLabel htmlFor="email" value="Email" />
          <TextInput
            id="email"
            type="email"
            name="email"
            value={data.email}
            className="mt-1 block w-full"
            autoComplete="username"
            autoCapitalize="off"
            minHeight={16}
            placeholder="Enter your email"
            onChange={(e) => setData('email', e.target.value)}
            required
          />
          <InputError message={errors.email} className="mt-2" />
        </div>

        {/* Input field for the user's password */}
        <div className="mt-4">
          <InputLabel htmlFor="password" value="Password" />
          <TextInput
            id="password"
            type={showPassword ? "text" : "password"}
            name="password"
            value={data.password}
            className="mt-1 block w-full"
            autoComplete="new-password"
            minHeight={16}
            placeholder="Enter your password"
            onChange={handlePasswordChange}
            onFocus={handlePasswordFocus}
            required
          />
          <InputError message={errors.password} className="mt-2" />

          {/* Button to toggle password visibility */}
          {showPassword ? (
            <button
              type="button"
              onClick={() => setShowPassword(false)}
              className="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
            >
              Hide password
            </button>
          ) : (
            <button
              type="button"
              onClick={() => setShowPassword(true)}
              className="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
            >
              Show password
            </button>
          )}
        </div>

        {/* Input field for confirming the user's password */}
        <div className="mt-4">
          <InputLabel htmlFor="password_confirmation" value="Confirm Password" />
          <TextInput
            id="password_confirmation"
            type={showPassword ? "text" : "password"}
            name="password_confirmation"
            value={data.password_confirmation}
            className="mt-1 block w-full"
            autoComplete="new-password"
            minHeight={16}
            placeholder="Confirm your password"
            onChange={(e) => setData('password_confirmation', e.target.value)}
            onFocus={handlePasswordFocus}
            required
          />
          <InputError message={errors.password_confirmation} className="mt-2" />
        </div>

        {/* Submit button for the registration form */}
        <div className="flex items-center justify-end mt-4">
