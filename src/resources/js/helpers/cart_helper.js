import axios from "axios";

const addToCartHelper = (user, productId, quantity) => {
    if (!user) return;
    const config = {
        headers: {
            Authorization: `Bearer ${user.token}`,
        },
    };
    const data = { 'product_id': productId, 'quantity': quantity };
    axios.post('/api/cart/add', data, config);
};

const removeFromCartHelper = (user, productId) => {
    if (!user) return;
    const config = {
        headers: {
            Authorization: `Bearer ${user.token}`,
        },
    };
    axios.delete(`/api/cart/${productId}`, config);
};

const getCartItemsHelper = async (user) => {
    if (!user) return null; // Return null if user is not available
    const config = {
        headers: {
            Authorization: `Bearer ${user.token}`,
        },
    };

    try {
        const response = await axios.get('/api/cart', config);
        const data = response.data.data;
        const modifiedData = data.map(item => {
            if (item.product && item.quantity < item.product.quantity) {
                item.product.left_items = item.product.quantity
                item.product.quantity = item.quantity;
                return item.product;
            }
        });

        return modifiedData;
    } catch (error) {
        // Handle error (optional)
        console.error('Error fetching cart items:', error);
        return null;
    }
};

export {
    addToCartHelper,
    removeFromCartHelper,
    getCartItemsHelper
}
