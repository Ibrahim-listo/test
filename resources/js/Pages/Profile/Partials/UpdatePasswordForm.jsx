import { useRef } from 'react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { useForm } from '@inertiajs/react';
import { Transition } from '@headlessui/react';

/**
 * UpdatePasswordForm component for updating the user's password
 * @param {object} props - The component props
 * @param {string} props.className - Optional. The CSS class for the component.
 * @returns {JSX.Element} The UpdatePasswordForm component.
 */
export default function UpdatePasswordForm({ className = '' }) {
  // Create refs for the password inputs
  const passwordInput = useRef();
  const currentPasswordInput = useRef();

  // Use the useForm hook to manage form state and submission
  const { data, setData, errors, put, reset, processing, recentlySuccessful } = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
  });

  /**
   * updatePassword function to handle form submission on Enter key press
   * @param {object} e - The event object
   */
  const updatePassword = (e) => {
    if (e.key === 'Enter') {
      e.preventDefault();
      put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => reset(),
        onError: (errors) => {
          if (errors.password) {
            reset('password', 'password_confirmation');
            passwordInput.current.focus();
          }

          if (errors.current_password) {
            reset('current_password');
            currentPasswordInput.current.focus();
          }

          if (errors.current_password) {
            reset('current_password');
            currentPasswordInput.current.setFocus();
          }
        },
      });
    }
  };

  return (
    <section className={className}>
      <header>
        <h2 className="text-lg font-medium text-gray-900 dark:text-gray-1
