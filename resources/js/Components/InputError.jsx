import PropTypes from 'prop-types';

export default function InputError({ message, className, ...props }) {
  const errorClasses = 'text-sm text-red-600 dark:text-red-400';

  // Return null if there's no error message
  if (!message) {
    return null;
  }

  // Spread the props object before the errorClasses to ensure it's not overwritten
  return <p {...props} className={`${errorClasses} ${className}`}>{message}</p>;
}

InputError.propTypes = {
  message: PropTypes.string,
  className: PropTypes.string,
};
