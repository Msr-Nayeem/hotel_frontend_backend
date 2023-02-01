import DashboardIcon from '../assets/icons/dashboard.svg';
import ShippingIcon from '../assets/icons/shipping.svg';
import UserIcon from '../assets/icons/user.svg';

const sidebar_menu = [
    
    {
        id: 1,
        icon: DashboardIcon,
        path: '/Home',
        title: 'Home',
    },
    {
        id: 2,
        icon: UserIcon,
        path: '/profile',
        title: 'Profile',
    },
    {
        id: 3,
        icon: UserIcon,
        path: '/AdminList',
        title: 'Admin',
    },
    {
        id: 4,
        icon: ShippingIcon,
        path: '/ReceiptionistList',
        title: 'Receiptionist',
    },
    {
        id: 5,
        icon: ShippingIcon,
        path: '/Rooms',
        title: 'Room',
    },
    {
        id: 6,
        icon: ShippingIcon,
        path: '/addRoom',
        title: 'Add Room',
    },

    {
        id: 7,
        icon: ShippingIcon,
        path: '/CustomerList',
        title: 'Customer',
    }
   
]

export default sidebar_menu;