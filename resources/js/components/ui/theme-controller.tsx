import { Appearance, useAppearance } from '@/hooks/use-appearance';

export default function ThemeController() {
    const { updateAppearance } = useAppearance();

    const tabs: { value: Appearance; label: string }[] = [
        { value: 'default', label: 'Default' },
        { value: 'light', label: 'Light' },
        { value: 'dark', label: 'Dark' },
        { value: 'retro', label: 'Retro' },
        { value: 'cyberpunk', label: 'Cyberpunk' },
        { value: 'synthwave', label: 'Synthwave' },
    ];

    return (
        <div className="dropdown">
            <div tabIndex={0} role="button" className="btn m-1">
                Theme
                <svg
                    width="12px"
                    height="12px"
                    className="inline-block h-2 w-2 fill-current opacity-60"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 2048 2048"
                >
                    <path d="M1799 349l242 241-1017 1017L7 590l242-241 775 775 775-775z"></path>
                </svg>
            </div>
            <ul tabIndex={0} className="dropdown-content z-1 w-52 rounded-box bg-base-300 p-2 shadow-2xl">
                {tabs.map(({ value, label }) => (
                    <li key={value}>
                        <input
                            type="radio"
                            name="theme-dropdown"
                            className="theme-controller btn btn-block w-full justify-start btn-ghost btn-sm"
                            aria-label={label}
                            value={value}
                            onClick={() => updateAppearance(value)}
                        />
                    </li>
                ))}
            </ul>
        </div>
    );
}
