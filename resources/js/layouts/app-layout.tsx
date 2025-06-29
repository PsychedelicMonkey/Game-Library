import { Footer } from '@/components/navigation/footer';
import { Navbar } from '@/components/navigation/navbar';
import Sidebar from '@/components/navigation/sidebar';
import { Drawer, DrawerContent, DrawerToggle } from '@/components/ui/drawer';
import type { PropsWithChildren } from 'react';

function AppLayout({ children }: PropsWithChildren) {
    return (
        <Drawer>
            <DrawerToggle />
            <DrawerContent className="flex flex-col">
                {/* Navbar */}
                <Navbar />

                {/* Page content */}
                <main className="min-h-screen pt-14">{children}</main>

                {/* Footer */}
                <Footer />
            </DrawerContent>

            {/* Mobile navigation */}
            <Sidebar />
        </Drawer>
    );
}

export { AppLayout };
