import store from '../store/modules/cart'; // Replace 'your-store' with the path to your store module
import axios from 'axios';

// Mock the axios library
jest.mock('axios', () => ({
    get: jest.fn(),
}));

describe('Store Mutations', () => {
    it('adds product to the cart', () => {
        const state = {
            cartItems: [],
        };

        const product = { id: 1, name: 'Product 1', price: 10.0, quantity: 3 };
        store.mutations.addToCart(state, product);

        expect(state.cartItems).toHaveLength(1);
        expect(state.cartItems[0]).toEqual({ ...product, quantity: 1 });
    });

    // Add more mutation tests if you have other mutations
});

describe('Store Actions', () => {
    it('calls the addToCart mutation when adding a product to the cart', () => {
        const commit = jest.fn();
        const product = { id: 1, name: 'Product 1', price: 10.0, quantity: 3 };

        store.actions.addToCart({ commit }, product);

        expect(commit).toHaveBeenCalledWith('addToCart', product);
    });

    // Add more action tests if you have other actions
});
