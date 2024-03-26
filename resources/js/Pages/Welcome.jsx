import { Link, Head } from '@inertiajs/react';

// Welcome component, responsible for displaying the welcome page
export default function Welcome({ auth, laravelVersion, phpVersion }) {
  // Function to handle image errors, hides the screenshot container and adjusts the layout
  const handleImageError = () => {
    document.getElementById('screenshot-container')?.classList.add('hidden');
    document.getElementById('docs-card')?.classList.add('row-span-1');
    document.getElementById('docs-card-content')?.classList.add('flex-row');
    document.getElementById('background')?.classList.add('hidden');
  };

  // JSX for the welcome page
  return (
    <>
      <Head title="Welcome" /> {/* Sets the title of the page */}
      <div className="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div className="absolute inset-0 -z-10">
          <img
            id="background"
            className="absolute -left-20 top-0 max-w-[877px] hidden"
            src="https://laravel.com/assets/img/welcome/background.svg"
          />
          <div
            id="screenshot-container"
            className="relative flex w-full max-w-2xl px-6 lg:max-w-7xl hidden"
          >
            <img
              src="https://laravel.com/assets/img/welcome/docs-light.svg"
              alt="Laravel documentation screenshot"
              className="aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.06)] dark:hidden"
              onError={handleImageError}
            />
            <img
              src="https://laravel.com/assets/img/welcome/docs-dark.svg"
              alt="Laravel documentation screenshot"
              className="hidden aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.25)] dark:block"
            />
            <div className="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900"></div>
          </div>
        </div>
        <div className="container mx-auto px-4 lg:px-0">
          <header className="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
            <div className="flex lg:justify-center lg:col-start-2">
              <svg
                className="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20]"
                viewBox="0 0 62 65"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8897 14.8858V28.5615C61.8898 28.737 61.8434 28.9095 61.7554 29.0614C61.6675 29.2132 61.5409 29.3392 61.3887 29.4265L49.9104 36.0351V49.1337C49.9104 49.4902 49.7209 49.8192 49.4118 49.9987L25.4519 63.7916C25.3971 63.8227 25.3372 63.8427 25.2774 63.8639C25.255 63.8714 25.2338 63.8851 25.2101 63.89
