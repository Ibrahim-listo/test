import { Link } from '@inertiajs/react';

type NavLinkProps = {
  active?: boolean; // whether or not the link is currently active
  className?: string; // additional classes to apply to the link
  children: React.ReactNode; // the content of the link
  role?: 'button' | 'link'; // restrict the possible values for the `role` prop
  title?: string; // tooltip text for the link
  dataTest?: string; // used for testing purposes
  // any other props will be spread onto the Link component
}

const baseStyles = // base styles for the link
  'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none';

const activeStyles = // styles for the active link
  'border-indigo-400 dark:border-indigo-600 text-gray-900 dark:text-gray-100 focus:border-indigo-700';

const inactiveStyles = // styles for the inactive link
  'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700';

export default function NavLink({
  active = false,
  className = '',
  children,
  role = 'button',
  title = '',
  dataTest = '',
  ...props // any other props will be spread onto the Link component
}: NavLinkProps) {
  return (
    <Link
      {...props} // spread any other props onto the Link component
      className={`${baseStyles} ${active ? activeStyles : inactiveStyles} ${className}`} // apply base, active, and inactive styles, as well as any additional classes
      role={role} // ensure the `role` prop is always set
      data-testid={dataTest} // use `data-testid` instead of `data
