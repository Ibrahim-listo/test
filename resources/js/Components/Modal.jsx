// Import necessary modules from 'react' and '@headlessui/react'
import { Fragment, ReactNode } from 'react';
import { Dialog, Transition } from '@headlessui/react';

// Define the type for ModalProps
type ModalProps = {
  children: ReactNode; // The content to be rendered inside the modal
  isOpen?: boolean; // Whether the modal is open or not
  maxWidth?: 'sm' | 'md' | 'lg' | 'xl' | '2xl'; // The maximum width of the modal
  closeable?: boolean; // Whether the modal can be closed by clicking on the backdrop
  backdropClose?: boolean; // Whether the modal can be closed by clicking on the close button
  transitionDuration?: string; // The duration of the transition animation
  onClose?: () => void; // The function to be called when the modal is closed
};

// Define the ModalContent component
const ModalContent = ({
  children, // The content to be rendered inside the modal
  maxWidthClass, // The maximum width class for the modal
}: {
  children: ReactNode; // The content to be rendered inside the modal
  maxWidthClass: string; // The maximum width class for the modal
}) => {
  return (
    <Dialog.Panel
      className={`mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto ${maxWidthClass}`} // The styles for the modal panel
    >
      {children}
    </Dialog.Panel>
  );
};

// Define the Modal component
export default function Modal({
  children,
  isOpen = false, // Whether the modal is open or not
  maxWidth = '2xl', // The maximum width of the modal
  closeable = true, // Whether the modal can be closed by clicking on the backdrop
  backdropClose = true, // Whether the modal can be closed by clicking on the close button
  transitionDuration = 'duration-300', // The duration of the transition animation
  onClose = () => {}, // The function to be called when the modal is closed
}: ModalProps) {
  // Calculate the maximum width class for the modal
  const maxWidthClass = {
    sm: 'sm:max-w-sm',
    md: 'sm:max-w-md',
    lg: 'sm:max-w-lg',
    xl: 'sm:max-w-xl',
    '2xl': 'sm:max-w-2xl',
  }[maxWidth];

  // Define the handleClose function to be called when the modal is closed
  const handleClose = () => {
    if (closeable) {
      onClose();
    }
  };

  // Render the modal
  return (
    <Transition show={isOpen} as={Fragment} leave={transitionDuration}>
      <Dialog
        as="div"
        id="modal"
        className="fixed inset-0 flex overflow-y-auto px-4 py-6 sm:px-0 items-center z-50 transform transition-all"
        onClose={handleClose}
      >
        {/* Render the backdrop for the modal */}
        <Transition.Child
          as={Fragment}
          enter="ease-out "
          enterFrom="opacity-0"
          enterTo="opacity-100"
          leave="ease-in "
          leaveFrom="opacity-100"
          leaveTo="opacity-0"
        >
          <div
            className="absolute inset-0 bg-gray-500/75 dark:bg-gray-900/75"
            onClick={() => backdropClose && handleClose()}
          />
        </Transition.Child>

        {/* Render the modal content */}
        <Transition.Child
          as={Fragment}
          enter={transitionDuration}
          enterFrom="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enterTo="opacity-
