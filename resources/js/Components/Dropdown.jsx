import { useState, createContext, useContext, Fragment } from 'react';
import { Link } from '@inertiajs/react';
import { Transition } from '@headlessui/react';

// Create a new context for the Dropdown component
const DropDownContext = createContext();

/**
 * The main Dropdown component that manages the state and behavior of the dropdown.
 * @param {React.ReactNode} children - The content to be displayed within the dropdown.
 */
const Dropdown = ({ children }) => {
  // Set up state for tracking whether the dropdown is open or not
  const [isOpen, setIsOpen] = useState(false);

  /**
   * Toggles the dropdown's open state.
   */
  const toggleOpen = () => {
    setIsOpen((prevState) => !prevState);
  };

  /**
   * Handles clicks outside of the dropdown to close it.
   * @param {MouseEvent} e - The click event.
   */
  const handleOutsideClick = (e) => {
    if (e.target.classList.contains('dropdown-context')) {
      setIsOpen(false);
    }
  };

  return (
    <DropDownContext.Provider value={{ isOpen, setIsOpen, toggleOpen }}>
      {/* Sets up a click event listener to handle closing the dropdown when clicking outside of it */}
      <div className="relative dropdown-context" onClick={handleOutsideClick}>
        {children}
      </div>
    </DropDownContext.Provider>
  );
};

/**
 * The Trigger component that displays the dropdown toggle button.
 * @returns {JSX.Element}
 */
const Trigger = () => {
  // Gets the dropdown context to access the dropdown state
  const { isOpen, toggleOpen } = useContext(DropDownContext);

  return (
    <>
      {/* Displays the dropdown toggle button */}
      <div onClick={toggleOpen}>{children}</div>

      {/* Displays a fixed overlay to catch clicks and close the dropdown */}
      {isOpen && <div className="fixed inset-0 z-40" onClick={() => setIsOpen(false)}></div>}
    </>
  );
};

/**
 * The Content component that displays the dropdown menu.
 * @param {Object} props - The component props.
 * @param {string} props.align - The alignment of the dropdown menu.
 * @param {string} props.width - The width of the dropdown menu.
 * @param {string} props.contentClasses - The additional classes for the dropdown menu.
 * @param {React.ReactNode} props.children - The content to be displayed within the dropdown menu.
 * @returns {JSX.Element}
 */
const Content = ({ align = 'right', width = '48', contentClasses = 'py-1 bg-white dark:bg-gray-700', children }) => {
  // Gets the dropdown context to access the dropdown state
  const { isOpen, setIsOpen } = useContext(DropDownContext);

  // Determines the alignment classes for the dropdown menu
  let alignmentClasses = 'origin-top';

  if (align === 'left') {
    alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
  } else if (align === 'right') {
    alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
  }

  // Determines the width classes for the dropdown menu
  let widthClasses = '';

  if (width === '48') {
    widthClasses = 'w-48';
  }

  return (
    <>
      {/* Displays the dropdown menu */}
      <Transition
        as={Fragment}
        show={isOpen}
        enter="transition ease-out duration-200"
        enterFrom="opacity-0 scale-95"
        enterTo="opacity-100 scale-100"
        leave="transition ease-in duration-75"
        leaveFrom="opacity-100 scale-100"
        leaveTo="opacity-0 scale-95"
      >
        <div
          // Adds click event listener to close the dropdown when clicking inside the menu
          onClick={(e) => {
            e.stopPropagation();
            setIsOpen(false);
          }}
          className={`absolute z-50 mt-2 rounded-md shadow-lg ${alignmentClasses} ${widthClasses} ${contentClasses}`}
        >
          {children}
        </div>
      </Transition>
   
