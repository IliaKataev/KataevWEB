//// Задание 4

function twoSum(nums, target) {
    let map = new Map();

    for (let i = 0; i < nums.length; i++) {
        let difference = target - nums[i];

        if (map.has(difference)) {
            return [map.get(difference), i];
        }
        map.set(nums[i], i);
    }
    return [];
}

const nums = [2, 7, 1, 9];
const target = 11;
const result = twoSum(nums, target);
console.log(result);
