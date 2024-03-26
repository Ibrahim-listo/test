import React from 'react';

type PrimaryButtonProps = React.ButtonHTMLAttributes<HTMLButtonElement> & {
  className?: string;
  disabledClassName?: string;
  children: React.ReactNode;
  type?: 'button' | 'submit' | 'reset';
  onClick?: React.MouseEventHandler<HTMLButtonElement>;
};

export default function PrimaryButton({
  className,
  disabled,
  disabledClassName,
  children,
  type = 'button',
  onClick,
  ...props
}: PrimaryButtonProps) {
  const buttonClassName = `
    inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest
    hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300
    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
    transition ease-in-out duration-150
    ${disabled ? disabledClassName || 'opacity-25' : ''}
    ${className}
  `;

  return (
    <button
      type={type}
      onClick={onClick}
      className={buttonClassName}
      disabled={disabled}
     
