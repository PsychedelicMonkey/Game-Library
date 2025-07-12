import useInitials from '@/hooks/use-initials';

function AvatarPlaceholder({ username }: { username: string }) {
    const getInitials = useInitials();

    return (
        <div className="avatar avatar-placeholder">
            <div className="w-24 rounded-full bg-neutral text-neutral-content">
                <span className="text-3xl">{getInitials(username)}</span>
            </div>
        </div>
    );
}

function AvatarPlaceholderSmall({ username }: { username: string }) {
    const getInitials = useInitials();

    return (
        <div className="avatar avatar-placeholder">
            <div className="w-16 rounded-full bg-neutral text-neutral-content">
                <span className="text-xl">{getInitials(username)}</span>
            </div>
        </div>
    );
}

export { AvatarPlaceholder, AvatarPlaceholderSmall };
