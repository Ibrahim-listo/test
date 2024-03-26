import PropTypes from 'prop-types';

// Default export of a functional component named Checkbox
export default function Checkbox({
  // List of props with their default values
  className = '',
  checked = false,
  name = '',
  id = '',
  tabIndex = 0,
  onChange = () => {}, // Default onChange function that does nothin
  ...props // Checkbox can take any additional props (e.g. style)
}) {
  // JSX returned by the component
  return (
    <label htmlFor={id} className="flex items-center">
      <input
        {...props}
        type="checkbox"
        className={`rounded ${className} dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600`}
        checked={checked}
        name={name}
        tabIndex={tabIndex}
        onChange={onChange}
      />
      <span className="ml-2 text-sm text-gray-600">
        {props.children}
      </span>
    </label>
  );
}

// propTypes validation for the component
Checkbox.propTypes = {
  className: PropTypes.string,
  checked: PropTypes.bool,
  name: PropTypes.string,
  id: PropTypes.string,
  tabIndex: PropTypes.number,
  onChange: PropTypes.func,
  children: PropTypes.node
};

