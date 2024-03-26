import { useEffect, useCallback, useRef, useState } from 'react';
import Checkbox from '@/Components/Checkbox';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Login({ status, canResetPassword }) {
    // Initialize the useForm hook with email, password, and remember fields
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    // Set up state for password visibility
    const [passwordVisible, setPasswordVisible] = useState(false);

    // Create a ref for the password input
    const passwordInputRef = useRef();

    // Set focus on the password input when the component mounts
    useEffect(() => {
        passwordInputRef.current.focus();
    }, []);

    // Callback function for handling password input focus
    const handlePasswordInputFocus = useCallback(() => {
        setPasswordVisible(true);
    }, []);

    // Callback function for handling password input blur
    const handlePasswordInputBlur = useCallback(() => {
        setPasswordVisible(false);
    }, []);

    // Submit function for handling form submission
    const submit = (e) => {
        e.preventDefault();

        post(route('login'));
    };

    // Render the component
    return (
        <GuestLayout>
            <Head title="Log in" />

            {/* Display status message if available */}
            {status && <div className="mb-4 font-medium text-sm text-green-600">{status}</div>}

            {/* Begin the form */}
            <form onSubmit={submit}>
                {/* Email input field */}
                <div>
                    <InputLabel htmlFor="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        className="mt-1 block w-full"
                        autoComplete="username"
                        autoFocus
                        isFocused={true}
                        onChange={(e) => setData('email', e.target.value)}
                        required
                        ref={passwordInputRef}
                    />

                    {/* Display email input error if available */}
                    <InputError message={errors.email} className="mt-2" />
                </div>

                {/* Password input field */}
                <div className="mt-4">
                    <InputLabel htmlFor="password" value="Password" />

                    <TextInput
                        id="password"
                        type={passwordVisible ? "text" : "password"}
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full"
                        autoComplete="current-password"
                        onFocus={handlePasswordInputFocus}
                        onBlur={handlePasswordInputBlur}
                        onChange={(e) => setData('password', e.target.value)}
                        required
                        minLength={8}
                        ref={passwordInputRef}
                    />

                    {/* Display password input error if available */}
                    <InputError message={errors.password} className="mt-2" />
                </div>

                {/* Remember me checkbox field */}
                <div className="block mt-4">
                    <label className="flex items-center">
                        <Checkbox
                            name="remember"
                            checked={data.remember}
                            onChange={(e) => setData('remember', e.target.checked)}
                            aria-label="Remember me"
                        />
                        <span className="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                    </label>
                </div>

                {/* Login button and forgot password link */}
                <div className="flex items-center justify-end mt-4">
                    {canResetPassword && (
                        <Link
                            href={route('password.request')}
                            className="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        >
                            Forgot your password?
                        </Link>
                    )}

                    {/* Login button */}
                    <PrimaryButton
                        type="submit"
                        className="ms-4"
                        disabled={processing}
                        tabIndex={-1}
                    >
                        Log in
                    </PrimaryButton>
                </div>
            </form>
        </GuestLayout>
    );
}

