import { AvatarPlaceholder } from '@/components/ui/avatar';
import { Card, CardBody, CardTitle } from '@/components/ui/card';
import { Skeleton } from '@/components/ui/skeleton';
import { Tooltip } from '@/components/ui/tooltip';
import type { Profile } from '@/types';

function ProfileCard({ profile }: { profile: Profile }) {
    return (
        <Card className="bg-base-100">
            <div className="m-4">
                <Tooltip data-tip={profile.username} placement="bottom">
                    {profile.avatar ? (
                        <div className="avatar">
                            <div className="w-24 rounded-full">
                                <img src={profile.avatar} alt="" />
                            </div>
                        </div>
                    ) : (
                        <AvatarPlaceholder username={profile.username} />
                    )}
                </Tooltip>
            </div>

            <CardBody>
                <CardTitle>{profile.username}</CardTitle>
                <p>{profile.bio}</p>
            </CardBody>
        </Card>
    );
}

function ProfileSkeleton() {
    return (
        <div className="flex flex-col gap-6">
            <Skeleton className="h-24 w-24 rounded-full" />
            <Skeleton className="h-6 w-44" />
            <Skeleton className="h-6 w-full" />
            <Skeleton className="h-6 w-full" />
        </div>
    );
}

export { ProfileCard, ProfileSkeleton };
