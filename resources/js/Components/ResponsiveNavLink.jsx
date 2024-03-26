import { Link } from '@inertiajs/react';

type ResponsiveNavLinkProps = {
  isActive?: boolean;
  className?: string;
  children: React.ReactNode;
};

const borderStyles = {
  inactive: 'border-transparent',
  active: 'border-indigo-400 dark:border-indigo-600',
};

const textStyles = {
  inactive: 'text-gray-600 dark:text-gray-400',
  active: 'text-indigo-700 dark:text-indigo-300',
};

const backgroundStyles = {
  inactive: 'bg-transparent',
  active: 'bg-indigo-50 dark:bg-indigo-900/50',
};

const hoverStyles = {
  inactive: 'hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600',
  active: 'hover:text-indigo-800 dark:hover:text-indigo-200 hover:bg-indigo-100 dark:hover:bg-indigo-900 hover:border-indigo-700 dark:hover:border-indigo-300',
};

const focusStyles = {
  inactive: 'focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500',
  active: 'focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500',
};

const ResponsiveNavLink = ({ isActive, className, children }: ResponsiveNavLinkProps) => {
  return (
    <Link
      href=""
      className={`
        block py-2 pl-3 pr-4 text-base font-medium ${isActive ? textStyles.active : textStyles.inactive}
