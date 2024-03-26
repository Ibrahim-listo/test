// Import necessary dependencies and components
import { useRef, useState } from 'react';
import { useForm } from '@inertiajs/react';
import DangerButton from '@/Components/DangerButton';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import Modal from '@/Components/Modal';
import SecondaryButton from '@/Components/SecondaryButton';
import TextInput from '@/Components/TextInput';

// Define the DeleteUserForm component
export default function DeleteUserForm({ className = '' }) {
    // Initialize state variables using the useState hook
    const [confirmingUserDeletion, setConfirmingUserDeletion] = useState(false);
    const passwordInputRef = useRef();

    // Initialize the form and related variables using the useForm hook
    const { data, setData, delete: destroy, processing, errors } = useForm({
        password: '', // The password field is initialized as an empty string
    });

    // Define the confirmUserDeletion function
    const confirmUserDeletion = () => {
        setConfirmingUserDeletion(true); // Set confirmingUserDeletion to true
    };

    // Define the deleteUser function
    const deleteUser = (e) => {
        if (e.key === 'Enter') { // If the Enter key is pressed
            e.preventDefault(); // Prevent the default behavior
            destroy(route('profile.destroy'), { // Call the destroy function
                preserveScroll: true, // Preserve the scroll position
                onSuccess: () => closeModal(), // Call closeModal on success
                onError: () => passwordInputRef.current.focus(), // Focus on the password input on error
                onFinish: () => reset(), // Call reset on finish
            });
        }
    };

    // Define the closeModal function
    const closeModal = () => {
        setConfirmingUserDeletion(false); // Set confirmingUserDeletion to false
        reset(); // Call the reset function
    };

    // Return the JSX for the component
    return (
        <section className={`space-y-6 ${className}`}>
            <header>
                <h2 className="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Delete Account
                </h2>
            </header>
            {/* Component code continues here */}
        </section>
