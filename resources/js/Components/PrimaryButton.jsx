import React from 'react';

type PrimaryButtonProps = React.ButtonHTMLAttributes<HTMLButtonElement> & {
  // Additional optional className for the button
  className?: string;
  // Additional optional className for the button when it's disabled
  disabledClassName?: string;
  // Children to be displayed inside the button
  children: React.ReactNode;
  // Type of the button ('button', 'submit', or 'reset')
  type?: 'button' | 'submit' | 'reset';
  // Function to be called when the button is clicked
  onClick?: React.MouseEventHandler<HTMLButtonElement>;
};

// Default export of the PrimaryButton component
export default function PrimaryButton({
  className,
  disabled,
  disabledClassName,
  children,
  type = 'button',
  onClick,
  ...props // Rest properties to support additional attributes
}: PrimaryButtonProps) {
  // Computed button class name based on props
  const buttonClassName = `
    inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest
    // Hover styles
    hover:bg-gray-700 dark:hover:bg-white
    // Focus styles
    focus:bg-gray-700 dark:focus:bg-white
    // Active styles
    active:bg-gray-900 dark:active:bg-gray-300
    // Focus outline styles
    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-8
