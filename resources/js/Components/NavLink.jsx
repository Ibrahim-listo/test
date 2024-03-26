import { Link } from '@inertiajs/react';

type NavLinkProps = {
  active?: boolean;
  className?: string;
  children: React.ReactNode;
  role?: 'button' | 'link'; // restrict the possible values for the `role` prop
  title?: string;
  dataTest?: string;
  // add any other props that you need
}

const baseStyles =
  'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none';

const activeStyles =
  'border-indigo-400 dark:border-indigo-600 text-gray-900 dark:text-gray-100 focus:border-indigo-700';

const inactiveStyles =
  'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700';

export default function NavLink({
  active = false,
  className = '',
  children,
  role = 'button',
  title = '',
  dataTest = '',
  ...props
}: NavLinkProps) {
  return (
    <Link
      {...props}
      className={`${baseStyles} ${active ? activeStyles : inactiveStyles} ${className}`}
      role={role} // ensure the `role` prop is always set
      data-testid={dataTest} // use `data-testid` instead of `dataTest` for consistency with React Testing Library
    >
      {children}
    </Link>
  );
}
