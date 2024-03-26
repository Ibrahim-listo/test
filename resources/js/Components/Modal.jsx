import { Fragment } from 'react';
import { Dialog, Transition } from '@headlessui/react';

type ModalProps = {
  children: React.ReactNode;
  show?: boolean;
  maxWidth?: 'sm' | 'md' | 'lg' | 'xl' | '2xl';
  closeable?: boolean;
  backdropClose?: boolean;
  transitionDuration?: string;
  onClose?: () => void;
};

type ModalContentProps = {
  children: React.ReactNode;
  maxWidthClass: string;
};

const ModalContent = ({ children, maxWidthClass }: ModalContentProps) => {
  return (
    <Dialog.Panel
      className={`mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto ${maxWidthClass}`}
    >
      {children}
    </Dialog.Panel>
  );
};

export default function Modal({
  children,
  show = false,
  maxWidth = '2xl',
  closeable = true,
  backdropClose = true,
  transitionDuration = 'duration-300',
  onClose = () => {},
}: ModalProps) {
  const maxWidthClass = {
    sm: 'sm:max-w-sm',
    md: 'sm:max-w-md',
    lg: 'sm:max-w-lg',
    xl: 'sm:max-w-xl',
    '2xl': 'sm:max-w-2xl',
  }[maxWidth];

  const close = () => {
    if (closeable) {
      onClose();
    }
  };

  return (
    <Transition show={show} as={Fragment} leave={transitionDuration}>
      <Dialog
        as="div"
        id="modal"
        className="fixed inset-0 flex overflow-y-auto px-4 py-6 sm:px-0 items-center z-50 transform transition-all"
        onClose={close}
      >
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
            onClick={() => backdropClose && close()}
          />
        </Transition.Child>

        <Transition.Child
          as={Fragment}
          enter={transitionDuration}
          enterFrom="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enterTo="opacity-100 translate-y-0 sm:scale-100"
          leave={transitionDuration}
          leaveFrom="opacity-100
