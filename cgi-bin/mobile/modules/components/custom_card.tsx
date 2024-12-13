import React from 'react';
import { View, Text, TouchableOpacity} from 'react-native';
import { LibNavigation } from "esoftplay/cache/lib/navigation/import";
import { LibStyle } from 'esoftplay/cache/lib/style/import';

interface CustomCardProps {
  number: string;
  title: string;
  subtitle: string;
}

const CustomCard: React.FC<CustomCardProps> = ({ number, title, subtitle }) => {
  const handlePress = () => {
    LibNavigation.navigate("parent/home");
  };

  return (
    <TouchableOpacity onPress={handlePress}>
      <View
        style={{
          marginLeft: 15,
          marginTop: 10,
          flexDirection: 'row',
          alignItems: 'center',
          borderWidth: 5,
          borderColor: '#4285F4',
          borderRadius: 8,
          overflow: 'hidden',
          backgroundColor: '#4B7AD6',
          width: LibStyle.width - 30,
          height: LibStyle.height * 0.1,
        }}
      >
        <View
          style={{
            marginLeft: 15,
            backgroundColor: '#FFFFFF',
            width: 50,
            height: '100%',
            justifyContent: 'center',
            alignItems: 'center',
            borderTopLeftRadius: 4,
            borderBottomLeftRadius: 4,
          }}
        >
          <Text
            style={{
              color: '#4B7AD6',
              fontSize: 18,
              fontWeight: 'bold',
            }}
          >
            {number}
          </Text>
        </View>
        <View
          style={{
            marginLeft: 2,
            flex: 1,
            padding: 10,
            backgroundColor: '#FFFFFF',
            justifyContent: 'center',
            alignItems: 'flex-start',
            borderTopRightRadius: 4,
            borderBottomRightRadius: 4,
            height: LibStyle.height * 0.1,
          }}
        >
          <Text
            style={{
              fontSize: 16,
              fontWeight: 'bold',
              color: '#4285F4',
              marginBottom: 8,
            }}
          >
            {title}
          </Text>
          <Text
            style={{
              fontSize: 14,
              color: '#4285F4',
              marginTop: 8,
              fontWeight: 'bold',
            }}
          >
            {subtitle}
          </Text>
        </View>
      </View>
    </TouchableOpacity>
  );
};

export default CustomCard;
