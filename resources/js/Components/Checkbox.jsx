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

Checkbox.propTypes = {
  className: PropTypes.string,
  checked: PropTypes.bool,
  name: PropTypes.string,
  id: PropTypes.string,
  tabIndex: PropTypes.number,
  onChange: PropTypes.func,
  children: PropTypes.node
};
