import GuestLayout from '@/Layouts/GuestLayout';
import PrimaryButton from '@/Components/PrimaryButton';
import { Head, Link, useForm } from '@inertiajs/react';

// This is the main function that handles email verification. It receives a 'status' prop.
export default function VerifyEmail({ status }) {
  // The 'useForm' hook is used to create a form with some additional functionality.
  // An empty object is passed as the initial form data.
  const { post, processing } = useForm({});

  // This is the event handler for form submission. It prevents the default form submission behavior,
  // and then calls the 'post' function with the route for sending email verification links.
  const submit = (e) => {
    e.preventDefault();

    post(route('verification.send'));
  };

  return (
    <GuestLayout>
      {/* This sets the title of the page using the 'Head' component from Inertia.js. */}
      <Head title="Email Verification" />

      <div className="mb-4 text-sm text-gray-60
