import { GameCard } from '@/components/game-card';
import { ProfileCard, ProfileSkeleton } from '@/components/profile-card';
import { Alert } from '@/components/ui/alert';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Collapse, CollapseContent, CollapseTitle } from '@/components/ui/collapse';
import FileInput from '@/components/ui/file-input';
import { Loading } from '@/components/ui/loading';
import { Modal } from '@/components/ui/modal';
import Progress from '@/components/ui/progress';
import RadialProgress from '@/components/ui/radial-progress';
import { RatingInput, ReadOnlyRating } from '@/components/ui/rating';
import { Stat, StatDesc, Stats, StatTitle, StatValue } from '@/components/ui/stat';
import { Tooltip } from '@/components/ui/tooltip';
import { AppLayout } from '@/layouts/app-layout';
import { Profile } from '@/types';
import { Game } from '@/types/library';
import { Head, WhenVisible } from '@inertiajs/react';

export default function Home({ games, profiles }: { games: Game[]; profiles?: Profile[] }) {
    return (
        <AppLayout>
            <Head title="Home Page" />

            {/*{!auth.user ? <ImageHero /> : <LoginHero />}*/}

            <div className="mx-auto max-w-7xl p-4 lg:pt-12">
                <div className="divider">Recently released</div>
                <div className="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5">
                    {games.map((game) => (
                        <GameCard key={game.id} game={game} />
                    ))}
                </div>
            </div>

            <div className="mx-auto max-w-7xl p-4 lg:p-6">
                <Collapse
                    tabIndex={0}
                    modifier="arrow"
                    className="border border-base-300 bg-primary text-primary-content focus:bg-secondary focus:text-secondary-content"
                >
                    <CollapseTitle className="font-semibol">How do I create an account?</CollapseTitle>
                    <CollapseContent className="text-sm">
                        Click the "Register" button in the top right corner and follow the registration process.
                    </CollapseContent>
                </Collapse>

                <Stats className="shadow">
                    <Stat>
                        <StatTitle>Total Page Views</StatTitle>
                        <StatValue>89,400</StatValue>
                        <StatDesc>21% more than last month</StatDesc>
                    </Stat>
                </Stats>
            </div>

            <div className="mx-auto max-w-7xl p-4 lg:p-6">
                <Tooltip data-tip="Hello">
                    <Button>Hover me</Button>
                </Tooltip>

                {/* @ts-expect-error Open the modal when button is clicked */}
                <Button onClick={() => document.getElementById('test-modal').showModal()}>Open modal</Button>
                <Modal id="test-modal">
                    <h1 className="text-lg font-bold">Hello!</h1>
                    <p className="py-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, eaque!</p>
                </Modal>
            </div>

            <div className="mx-auto flex max-w-7xl gap-4 p-4 lg:p-6">
                <RatingInput name="user-rating" id="user-rating" />

                <Tooltip data-tip="2 stars" placement="bottom">
                    <ReadOnlyRating rating={2} />
                </Tooltip>

                <RadialProgress value={70} color="warning" />
            </div>

            <div className="mx-auto min-h-screen max-w-7xl space-y-6 p-4 lg:p-6">
                <div className="flex gap-2">
                    <Button>Hello</Button>
                    <Button color="primary">Hello</Button>
                    <Button color="secondary">Hello</Button>
                    <Button color="accent">Hello</Button>
                    <Button color="info">Hello</Button>
                    <Button color="success">Hello</Button>
                    <Button color="error">Hello</Button>
                    <Button color="warning">Hello</Button>
                </div>
                Outline
                <div className="flex gap-2">
                    <Button buttonStyle="outline">Hello</Button>
                    <Button color="primary" buttonStyle="outline">
                        Hello
                    </Button>
                    <Button color="secondary" buttonStyle="outline">
                        Hello
                    </Button>
                    <Button color="accent" buttonStyle="outline">
                        Hello
                    </Button>
                    <Button color="info" buttonStyle="outline">
                        Hello
                    </Button>
                    <Button color="success" buttonStyle="outline">
                        Hello
                    </Button>
                    <Button color="error" buttonStyle="outline">
                        Hello
                    </Button>
                    <Button color="warning" buttonStyle="outline">
                        Hello
                    </Button>
                </div>
                Soft
                <div className="flex gap-2">
                    <Button buttonStyle="soft">Hello</Button>
                    <Button color="primary" buttonStyle="soft">
                        Hello
                    </Button>
                    <Button color="secondary" buttonStyle="soft">
                        Hello
                    </Button>
                    <Button color="accent" buttonStyle="soft">
                        Hello
                    </Button>
                    <Button color="info" buttonStyle="soft">
                        Hello
                    </Button>
                    <Button color="success" buttonStyle="soft">
                        Hello
                    </Button>
                    <Button color="error" buttonStyle="soft">
                        Hello
                    </Button>
                    <Button color="warning" buttonStyle="soft">
                        Hello
                    </Button>
                </div>
                Dash
                <div className="flex gap-2">
                    <Button buttonStyle="dash">Hello</Button>
                    <Button color="primary" buttonStyle="dash">
                        Hello
                    </Button>
                    <Button color="secondary" buttonStyle="dash">
                        Hello
                    </Button>
                    <Button color="accent" buttonStyle="dash">
                        Hello
                    </Button>
                    <Button color="info" buttonStyle="dash">
                        Hello
                    </Button>
                    <Button color="success" buttonStyle="dash">
                        Hello
                    </Button>
                    <Button color="error" buttonStyle="dash">
                        Hello
                    </Button>
                    <Button color="warning" buttonStyle="dash">
                        Hello
                    </Button>
                </div>
                Link
                <div className="flex gap-2">
                    <Button buttonStyle="link">Hello</Button>
                    <Button color="primary" buttonStyle="link">
                        Hello
                    </Button>
                    <Button color="secondary" buttonStyle="link">
                        Hello
                    </Button>
                    <Button color="accent" buttonStyle="link">
                        Hello
                    </Button>
                    <Button color="info" buttonStyle="link">
                        Hello
                    </Button>
                    <Button color="success" buttonStyle="link">
                        Hello
                    </Button>
                    <Button color="error" buttonStyle="link">
                        Hello
                    </Button>
                    <Button color="warning" buttonStyle="link">
                        Hello
                    </Button>
                </div>
                Ghost
                <div className="flex gap-2">
                    <Button buttonStyle="ghost">Hello</Button>
                    <Button color="primary" buttonStyle="ghost">
                        Hello
                    </Button>
                    <Button color="secondary" buttonStyle="ghost">
                        Hello
                    </Button>
                    <Button color="accent" buttonStyle="ghost">
                        Hello
                    </Button>
                    <Button color="info" buttonStyle="ghost">
                        Hello
                    </Button>
                    <Button color="success" buttonStyle="ghost">
                        Hello
                    </Button>
                    <Button color="error" buttonStyle="ghost">
                        Hello
                    </Button>
                    <Button color="warning" buttonStyle="ghost">
                        Hello
                    </Button>
                </div>
                <div className="flex gap-2">
                    <Badge>New</Badge>
                    <Badge color="primary">New</Badge>
                    <Badge color="secondary">New</Badge>
                    <Badge color="accent">New</Badge>
                    <Badge color="info">New</Badge>
                    <Badge color="success">New</Badge>
                    <Badge color="warning">New</Badge>
                    <Badge color="error">New</Badge>
                </div>
                <div className="flex gap-2">
                    <Badge badgeStyle="dash">New</Badge>
                    <Badge color="primary" badgeStyle="dash">
                        New
                    </Badge>
                    <Badge color="secondary" badgeStyle="dash">
                        New
                    </Badge>
                    <Badge color="accent" badgeStyle="dash">
                        New
                    </Badge>
                    <Badge color="info" badgeStyle="dash">
                        New
                    </Badge>
                    <Badge color="success" badgeStyle="dash">
                        New
                    </Badge>
                    <Badge color="warning" badgeStyle="dash">
                        New
                    </Badge>
                    <Badge color="error" badgeStyle="dash">
                        New
                    </Badge>
                </div>
                <div className="flex gap-2">
                    <Badge badgeStyle="outline">New</Badge>
                    <Badge color="primary" badgeStyle="outline">
                        New
                    </Badge>
                    <Badge color="secondary" badgeStyle="outline">
                        New
                    </Badge>
                    <Badge color="accent" badgeStyle="outline">
                        New
                    </Badge>
                    <Badge color="info" badgeStyle="outline">
                        New
                    </Badge>
                    <Badge color="success" badgeStyle="outline">
                        New
                    </Badge>
                    <Badge color="warning" badgeStyle="outline">
                        New
                    </Badge>
                    <Badge color="error" badgeStyle="outline">
                        New
                    </Badge>
                </div>
                <div className="flex gap-2">
                    <Badge badgeStyle="soft">New</Badge>
                    <Badge color="primary" badgeStyle="soft">
                        New
                    </Badge>
                    <Badge color="secondary" badgeStyle="soft">
                        New
                    </Badge>
                    <Badge color="accent" badgeStyle="soft">
                        New
                    </Badge>
                    <Badge color="info" badgeStyle="soft">
                        New
                    </Badge>
                    <Badge color="success" badgeStyle="soft">
                        New
                    </Badge>
                    <Badge color="warning" badgeStyle="soft">
                        New
                    </Badge>
                    <Badge color="error" badgeStyle="soft">
                        New
                    </Badge>
                </div>
                <div className="flex gap-2">
                    <Badge badgeStyle="ghost">New</Badge>
                    <Badge color="primary" badgeStyle="ghost">
                        New
                    </Badge>
                    <Badge color="secondary" badgeStyle="ghost">
                        New
                    </Badge>
                    <Badge color="accent" badgeStyle="ghost">
                        New
                    </Badge>
                    <Badge color="info" badgeStyle="ghost">
                        New
                    </Badge>
                    <Badge color="success" badgeStyle="ghost">
                        New
                    </Badge>
                    <Badge color="warning" badgeStyle="ghost">
                        New
                    </Badge>
                    <Badge color="error" badgeStyle="ghost">
                        New
                    </Badge>
                </div>
                <div className="flex gap-2">
                    <Loading />
                    <Loading type="dots" />
                    <Loading type="ball" />
                    <Loading type="bars" />
                    <Loading type="ring" />
                    <Loading type="infinity" />
                </div>
                <div className="flex gap-2">
                    <Loading size="xl" />
                    <Loading type="dots" size="xl" />
                    <Loading type="ball" size="xl" />
                    <Loading type="bars" size="xl" />
                    <Loading type="ring" size="xl" />
                    <Loading type="infinity" size="xl" />
                </div>
                <div className="flex gap-2">
                    <Loading color="neutral" />
                    <Loading color="primary" />
                    <Loading color="secondary" />
                    <Loading color="accent" />
                    <Loading color="info" />
                    <Loading color="success" />
                    <Loading color="warning" />
                    <Loading color="error" />
                </div>
                <div className="flex flex-col gap-4">
                    <Alert color="info" message="Info message" icon />
                    <Alert color="success" message="Success message" icon />
                    <Alert color="warning" message="Warning message" icon />
                    <Alert color="error" message="Error message" icon />
                </div>
                <div className="flex flex-col gap-4">
                    <Alert color="info" message="Info message" alertStyle="soft" />
                    <Alert color="success" message="Success message" alertStyle="soft" />
                    <Alert color="warning" message="Warning message" alertStyle="soft" />
                    <Alert color="error" message="Error message" alertStyle="soft" />
                </div>
                <div className="flex flex-col gap-4">
                    <Alert color="info" message="Info message" alertStyle="outline" />
                    <Alert color="success" message="Success message" alertStyle="outline" />
                    <Alert color="warning" message="Warning message" alertStyle="outline" />
                    <Alert color="error" message="Error message" alertStyle="outline" />
                </div>
                <div className="flex flex-col gap-4">
                    <Progress />
                    <Progress color="primary" />
                    <Progress color="secondary" value={20} max="100" />
                </div>
                <div className="flex gap-4">
                    <FileInput />
                    <FileInput color="success" />
                    <FileInput size="xl" />
                </div>
            </div>

            {/* Profile cards */}
            <div>
                <WhenVisible
                    data={['profiles']}
                    fallback={
                        <div className="grid grid-cols-1 gap-4 p-4 md:grid-cols-2 lg:grid-cols-4 lg:p-6">
                            {[...Array(8)].map((value, index) => (
                                <ProfileSkeleton key={index} />
                            ))}
                        </div>
                    }
                >
                    <div className="grid grid-cols-1 gap-4 p-4 md:grid-cols-2 lg:grid-cols-4 lg:p-6">
                        {profiles?.map((profile) => <ProfileCard profile={profile} key={profile.id} />)}
                    </div>
                </WhenVisible>
            </div>
        </AppLayout>
    );
}
