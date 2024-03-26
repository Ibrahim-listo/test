import { useEffect, useState } from 'react';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Register() {
  const [showPassword, setShowPassword] = useState(false);

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

  useEffect(() => {
    return () => {
      reset('password', 'password_confirmation');
    };
  }, []);

  const submit = (e) => {
    e.preventDefault();

    post(route('register'));
  };

  const handlePasswordChange = (e) => {
    setData('password_confirmation', '');
    setData('password', e.target.value);
  };

  const handlePasswordFocus = () => {
    setData('password', '');
    setData('password_confirmation', '');
    reset('password', 'password_confirmation');
  };

  return (
    <GuestLayout>
      <Head title="Register" />

      <form onSubmit={submit}>
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

        <div className="flex items-center justify-end mt-4">
          <Link
            href={route('login')}
            tabIndex={0}
            className="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none
