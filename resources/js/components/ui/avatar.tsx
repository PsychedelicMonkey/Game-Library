function AvatarPlaceholder({ initials }: { initials: string }) {
    return (
        <div className="avatar avatar-placeholder">
            <div className="w-24 rounded-full bg-neutral text-neutral-content">
                <span className="text-3xl">{initials}</span>
            </div>
        </div>
    );
}

export { AvatarPlaceholder };
