import PropTypes from 'prop-types';

export default function Checkbox({
  className = '',
  checked = false,
  name = '',
  id = '',
  tabIndex = 0,
  onChange = () => {},
  ...props
}) {
  return (
    <label htmlFor={id}>
      <input
        {...props}
        type="checkbox"
        className={
          'rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-60
