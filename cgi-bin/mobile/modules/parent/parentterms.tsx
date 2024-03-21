// withHooks
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';

import React from 'react';
import { Button, Pressable, Text, View } from 'react-native';


export interface ParentTermsArgs {
    
}
export interface ParentTermsProps {
    
}
export default function m(props: ParentTermsProps): any {
    return (
        <View style={{flex:1}}>
            <Pressable onPress={()=>LibNavigation.back}>
               <Text>Back</Text>
            </Pressable>
            <Text>
            By using our attendance app, you agree to these straightforward terms. Create your account responsibly, keep information accurate, and follow the law. We handle your data as explained in our Privacy Policy [insert link]. It's your responsibility to ensure attendance info is correct, and only authorized personnel should access it. We own the app, grant you permission to use it, and can terminate access if rules are broken. We're not liable for issues, so use the app responsibly. We might update terms, so check them periodically. These terms follow the laws of [Your Jurisdiction]. Contact us at [Your Contact Information] for any questions.
            </Text>
        </View>
    )
}